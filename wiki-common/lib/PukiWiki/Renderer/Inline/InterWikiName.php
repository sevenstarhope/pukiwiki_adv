<?php
/**
 * InterWikiName変換クラス
 *
 * @package   PukiWiki\Renderer\Inline
 * @access    public
 * @author    Logue <logue@hotmail.co.jp>
 * @copyright 2012-2013 PukiWiki Advance Developers Team
 * @create    2012/12/18
 * @license   GPL v2 or (at your option) any later version
 * @version   $Id: InterWikiName.php,v 1.0.0 2013/01/29 19:54:00 Logue Exp $
 */

namespace PukiWiki\Renderer\Inline;

use PukiWiki\Factory;
use PukiWiki\Utility;
use PukiWiki\Renderer\RendererDefines;

/**
 * InterWikiName-rendered URLs
 */
class InterWikiName extends Inline
{
	const INTERWIKINAME_PAGENAME = 'InterWikiName';
	const INTERWIKINAME_PATTERN = '/\[((?:(?:https?|ftp|news):\/\/|\.\.?\/)[!~*\'();\/?:\@&=+\$,%#\w.-]*)\s([^\]]+)\]\s?([^\s]*)/';
	const INTERWIKINAME_CACHE = 'interwikiname';
	const INTERWIKINAME_MAX_LENGTH = 512;

	private static $encode_aliases = array(
		'sjis'  => 'SJIS',
		'euc'   => 'EUC-JP',
		'utf8'  => 'UTF-8',
		'gbk'   => 'CP936',
		'euckr' => 'EUC-KR',
		'big5'  => 'BIG5'
	);

	var $url    = '';
	var $param  = '';
	var $anchor = '';
	private $interwikiname;

	public function __construct($start)
	{
		parent::__construct($start);
	}

	public function getPattern()
	{
		$s2 = $this->start + 2;
		$s5 = $this->start + 5;
		return
			'\[\['.                  // open bracket
			'(?:'.
			 '((?:(?!\]\]).)+)>'.    // (1) alias
			')?'.
			'(\[\[)?'.               // (2) open bracket
			'((?:(?!\s|:|\]\]).)+)'. // (3) InterWiki
			'(?<! > | >\[\[ )'.      // not '>' or '>[['
			':'.                     // separator
			'('.                     // (4) param
			 '(\[\[)?'.              // (5) open bracket
			 '(?:(?!>|\]\]).)+'.
			 '(?(' . $s5 . ')\]\])'. // close bracket if (5)
			')'.
			'(?(' . $s2 . ')\]\])'.  // close bracket if (2)
			'\]\]';                  // close bracket
	}

	public function getCount()
	{
		return 5;
	}

	public function setPattern($arr, $page)
	{
		list(, $alias, , $this->interwikiname, $this->param) = $this->splice($arr);
		$matches = array();
		if (preg_match('/^([^#]+)(#[A-Za-z][\w-]*)$/', $this->param, $matches))
			list(, $this->param, $this->anchor) = $matches;

		$url = self::getInterWikiUrl($this->interwikiname, $this->param);
		if ($url === FALSE) return $this->interwikiname . ':' . $this->param;
		$this->url = Utility::htmlsc($url);

		return parent::setParam(
			$page,
			Utility::htmlsc($this->interwikiname . ':' . $this->param),
			null,
			'InterWikiName',
			empty($alias) ? $this->interwikiname . ':' . $this->param : $alias
		);
	}

	public function __toString()
	{
		global $nofollow;
		$icon = parent::isInsideUri($this->url) ? RendererDefines::INTERNAL_LINK_ICON : RendererDefines::EXTERNAL_LINK_ICON;
		$target = (empty($this->redirect)) ? $this->url : $this->redirect.rawurlencode($this->url);

		if (!$this->url){
			return sprintf(RendererDefines::NOEXISTS_STRING, $this->interwikiname. ':' .$this->param);
		}
		return '<a href="' . $target . $this->anchor . '" title="' . $this->name . '" rel="' . ($nofollow === FALSE ? 'external' : 'external nofollow') . '">'. RendererDefines::INTERWIKINAME_ICON . $this->alias . $icon . '</a>';
	}

	/**
	 * InterWikiNameをURLに変換する
	 * @param string $name InterWiki名
	 * @param string $param InterWikiに送るパラメータ
	 * @return string
	 */
	public static function getInterWikiUrl($name, $param = '')
	{
		$interwikinames = self::getInterWikiNameDict();

		if (! isset($interwikinames[$name])) return FALSE;

		list($url, $opt) = $interwikinames[$name];
		
		if (!empty($param)){

			// Encoding
			switch ($opt) {

				case '':    /* FALLTHROUGH */
				case 'std': // Simply URL-encode the string, whose base encoding is the internal-encoding
					$param = rawurlencode($param);
					break;

				case 'asis': /* FALLTHROUGH */
				case 'raw' : // Truly as-is
					break;

				case 'yw': // YukiWiki
					if (! preg_match('/' . Utility::WIKINAME_PATTERN . '/', $param))
						$param = '[[' . mb_convert_encoding($param, 'SJIS', SOURCE_ENCODING) . ']]';
					break;

				case 'moin': // MoinMoin
					$param = str_replace('%', '_', rawurlencode($param));
					break;

				default:
					// Alias conversion of $opt
					if (isset($encode_aliases[$opt])) $opt = & $encode_aliases[$opt];

					// Encoding conversion into specified encode, and URLencode
					$param = rawurlencode(mb_convert_encoding($param, $opt, SOURCE_ENCODING));
			}

			// Replace or Add the parameter
			if (strpos($url, '$1') !== FALSE) {
				$url = str_replace('$1', $param, $url);
				//$url = strtr($url, '$1', $param);
			} else {
				$url .= $param;
			}
		}

		$len = strlen($url);
		if ($len > self::INTERWIKINAME_MAX_LENGTH) Utility::dieMessage('InterWiki URL too long: ' . $len . ' characters');

		return $url;
	}
	/**
	 * InterWikiNameページから辞書を作成する
	 * @param boolean $force キャッシュを再生成する
	 * @return array
	 */
	private static function getInterWikiNameDict($force = false){
		global $interwiki, $cache;
		static $interwikinames;
	
		$wiki = Factory::Wiki($interwiki);
		if (! $wiki->has()) return null;

		// InterWikiNameの更新チェック
		if ($cache['wiki']->hasItem(self::INTERWIKINAME_CACHE)){
			$term_cache_meta = $cache['wiki']->getMetadata(self::INTERWIKINAME_CACHE);
			if ($term_cache_meta['mtime'] < $wiki->time()) {
				$force = true;
			}
		}

		// キャッシュ処理
		if ($force) {
			unset($interwikinames);
			$cache['wiki']->removeItem(self::INTERWIKINAME_CACHE);
		}else if (!empty($interwikinames)) {
			return $interwikinames;
		}else if ($cache['wiki']->hasItem(self::INTERWIKINAME_CACHE)) {
			$interwikinames = $cache['wiki']->getItem(self::INTERWIKINAME_CACHE);
			$cache['wiki']->touchItem(self::INTERWIKINAME_CACHE);
			return $interwikinames;
		}

		// 定義ページより生成。
		$interwikinames = $matches = array();
		foreach ($wiki->get() as $line)
			if (preg_match(self::INTERWIKINAME_PATTERN, $line, $matches))
				$interwikinames[$matches[2]] = array($matches[1], $matches[3]);

		// キャッシュ保存
		$cache['wiki']->setItem(self::INTERWIKINAME_CACHE, $interwikinames);

		return $interwikinames;
	}
}

/* End of file InterWikiName.php */
/* Location: /vender/PukiWiki/Lib/Renderer/Inline/InterWikiName.php */