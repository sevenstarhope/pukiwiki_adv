<?php
/**
 * WikiテキストをHTMLに変換する
 *
 * @package   PukiWiki\Renderer
 * @access    public
 * @author    Logue <logue@hotmail.co.jp>
 * @copyright 2013 PukiWiki Advance Developers Team
 * @create    2013/01/26
 * @license   GPL v2 or (at your option) any later version
 * @version   $Id: RendererFactory.php,v 1.0.0 2013/01/10 17:28:00 Logue Exp $
 **/

namespace PukiWiki\Renderer;

use PukiWiki\Renderer\Element\RootElement;

/**
 * レンダラーファクトリークラス
 */
class RendererFactory{
	/**
	 * ファクトリーメソッド
	 * @param array or string $lines Wikiテキスト
	 * @return string
	 */
	public static function factory($lines){
		static $id;

		if (!is_array($lines)){
			// ポカミス用（旧line2arrayの処理を入れておく）
			$x = preg_replace(
				array("[\\r\\n]","[\\r]"),
				array("\n","\n"),
				$lines
			); // 行末の統一
			$lines = explode("\n",$x);
		}

		$body = new RootElement(++$id);
		$body->parse($lines);

		return $body->toString();
	}
}

/* End of file RendererFactory.php */
/* Location: ./vendor/PukiWiki/Lib/Renderer/RendererFactory.php */