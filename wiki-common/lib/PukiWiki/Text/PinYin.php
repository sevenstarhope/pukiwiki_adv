<?php
/**
 * ピンインクラス
 *
 * @package   PukiWiki\Text
 * @access    public
 * @author    Logue <logue@hotmail.co.jp>
 * @copyright 2013 PukiWiki Advance Developers Team
 * @create    2013/02/03
 * @license   GPL v2 or (at your option) any later version
 * @version   $Id: PinYin.php,v 1.0.0 2013/02/13 18:58:00 Logue Exp $
 **/

namespace PukiWiki\Text;

/**
 * 簡体字をピンインに変換するクラス
 * 
 * http://ja.wikipedia.org/wiki/%E3%83%94%E3%83%B3%E9%9F%B3
 * 以下のように変換されます↓
 * PinYin::toPinYin(我不知道中文);→wobuzhidaozhongwen
 * PinYin::toKana(我不知道中文);→ウオブゥジーダオジョーンウエン
 */
class PinYin {
	// 拼音漢字変換表
	// http://qingdaonet.org/dic/pinin.htm
	static protected $pinyin_table = array(
		'a'         => '阿|啊|呵|锕|吖|腌|嗄',
		'ai'        => '爱|嫒|暧|瑷|哀|锿|挨|埃|诶|唉|隘|嗌|艾|哎|砹|癌|蔼|霭|矮|碍|皑',
		'an'        => '安|按|桉|氨|铵|庵|俺|鹌|埯|胺|鞍|桉|案|暗|揞|黯|谙|岸',
		'ang'       => '昂|盎|肮',
		'ao'        => '奥|澳|懊|熬|傲|嗷|敖|廒|遨|鳌|骜|螯|獒|岙|袄|凹|坳|拗|嚣|媪',
		
		'ba'        => '巴|岜|爸|把|吧|靶|耙|芭|笆|疤|粑|钯|八|扒|叭|拔|跋|魃|茇|霸|灞|罢|捌|坝',
		'bai'       => '白|伯|柏|百|佰|捭|稗|败|呗|拜|摆|掰',
		'ban'       => '半|伴|绊|拌|版|板|扳|坂|阪|钣|舨|般|搬|瘢|班|斑|癍|办|瓣|颁|扮',
		'bang'      => '邦|绑|梆|帮|榜|傍|磅|膀|镑|谤|蒡|棒|浜|蚌',
		'bao'       => '包|饱|饱|刨|胞|炮|苞|鲍|龅|雹|报|保|褓|葆|堡|煲|褒|宝|薄|豹|暴|爆|剥|趵|鸨',
		'bei'       => '被|陂|倍|焙|碚|蓓|北|邶|背|褙|臂|杯|贝|呗|狈|钡|辈|悲|卑|碑|萆|悖|鹎|备|惫|鞴|鐾',
		'ben'       => '本|苯|笨|奔|贲|锛|坌|夯|畚',
		'beng'      => '蚌|崩|绷|蹦|嘣|泵|甭|迸|甏',
		'bi'        => '匕|比|毙|秕|妣|吡|庇|毖|毕|陛|篦|蓖|必|秘|铋|笔|滗|臂|鼻|濞|敝|弊|辟|碧|璧|壁|避|襞|畀|裨|婢|俾|髀|庳|痹|弼|蔽|贲|币|逼|彼|闭|拂|愎|鄙',
		'bian'      => '边|笾|扁|编|遍|鳊|褊|煸|蝙|碥|匾|辩|辨|辫|弁|卞|汴|忭|苄|便|鞭|缏|变|贬|砭|窆',
		'biao'      => '表|裱|婊|标|膘|镖|骠|瘭|鳔|勺|杓|彪|髟|飙|镳|飑',
		'bie'       => '别|鳖|憋|瘪|蹩',
		'bin'       => '宾|滨|膑|殡|傧|槟|镔|摈|缤|髌|鬓|斌|彬|濒|豳|玢',
		'bing'      => '并|饼|屏|摒|丙|炳|柄|病|兵|冰|秉|禀|邴',
		'bo'        => '脖|勃|渤|鹁|波|玻|跛|拨|菠|簸|伯|铂|泊|舶|柏|箔|博|博|膊|搏|薄|播|趵|驳|帛|擘|檗|钹|钵|踣|卜|亳|般',
		'bu'        => '不|钚|布|怖|钸|卜|卟|补|捕|哺|晡|埔|逋|簿|埠|部|步|醭|瓿',
		
		'ca'        => '擦|嚓|礤|拆',
		'cai'       => '才|材|财|采|菜|彩|踩|睬|蔡|裁|猜',
		'can'       => '参|骖|掺|惨|残|餐|蚕|灿|惭|粲|璨',
		'cang'      => '藏|仓|舱|苍|沧|伧',
		'cao'       => '曹|草|槽|漕|嘈|螬|艚|操|糙',
		'ce'        => '册|策|侧|测|厕|恻',
		'ceng'      => '层|曾|蹭|噌',
		'cha'       => '差|槎|查|碴|喳|馇|楂|猹|茶|搽|插|锸|察|嚓|镲|檫|叉|衩|杈|汊|诧|姹|茬|岔|刹',
		'chai'      => '拆|差|柴|钗|虿|侪|豺',
		'chan'      => '产|铲|单|禅|蝉|婵|阐|馋|搀|谗|孱|潺|骣|冁|冁|镡|缠|颤|蟾|谄|躔|廛|澶|忏|蒇|羼|觇',
		'chang'     => '厂|长|伥|怅|苌|场|肠|畅|昌|唱|倡|娼|猖|鲳|阊|菖|尝|偿|倘|徜|惝|敞|氅|常|嫦|裳|昶|鬯',
		'chao'      => '超|吵|炒|钞|抄|耖|朝|潮|嘲|巢|剿|绰|焯|晁|怊',
		'che'       => '车|砗|撤|澈|扯|彻|尺|坼|掣',
		'chen'      => '陈|沉|尘|称|臣|秤|晨|谌|辰|趁|衬|忱|琛|橙|郴|宸|碜|榇|嗔|龀|伧|抻|谶',
		'cheng'     => '成|城|诚|铖|蛏|柽|称|呈|程|逞|埕|裎|承|盛|乘|撑|澄|惩|秤|橙|铛|丞|枨|瞠|噌|骋|酲|塍',
		'chi'       => '吃|齿|持|池|弛|驰|尺|迟|赤|哧|痴|踟|耻|翅|斥|叱|匙|炽|豉|蚩|嗤|媸|茌|墀|坻|鸱|侈|眵|傺|螭|魑|篪|褫|啻|笞|敕|饬',
		'chong'     => '冲|种|忡|崇|虫|充|茺|宠|重|憧|艟|涌|舂|铳',
		'chou'      => '抽|愁|瞅|丑|筹|畴|帱|俦|踌|绸|稠|惆|仇|臭|酬|雠|瘳',
		'chu'       => '出|础|黜|绌|刍|雏|处|初|除|蜍|滁|楚|憷|储|褚|楮|躇|触|锄|厨|橱|蹰|矗|怵|畜|搐|樗|杵',
		'chuai'     => '啜|揣|踹|嘬|搋|膪',
		'chuan'     => '船|传|川|钏|穿|串|喘|遄|椽|舛|氚|舡',
		'chuang'    => '创|疮|怆|闯|床|窗|幢',
		'chui'      => '吹|炊|锤|槌|垂|捶|陲|棰|椎',
		'chun'      => '春|椿|蝽|蠢|醇|淳|纯|莼|唇|鹑',
		'chuo'      => '绰|焯|踔|辍|啜|戳|龊',
		'ci'        => '次|茨|此|疵|雌|词|伺|祠|辞|兹|慈|磁|鹚|糍|刺|瓷|赐|差',
		'cong'      => '从|丛|枞|苁|匆|葱|琮|淙|囱|璁|骢|聪',
		'cou'       => '凑|腠|辏|楱',
		'cu'        => '粗|殂|徂|促|簇|醋|猝|酢|蹴|蹙',
		'cuan'      => '窜|蹿|镩|撺|攒|汆|篡|爨',
		'cui'       => '隹|崔|催|摧|璀|萃|翠|粹|悴|瘁|啐|淬|衰|榱|脆|毳',
		'cun'       => '村|寸|忖|存|蹲|皴',
		'cuo'       => '错|措|厝|挫|矬|锉|脞|搓|蹉|嵯|瘥|鹾|磋|撮',

		'da'        => '大|达|哒|鞑|打|答|搭|嗒|沓|瘩|褡|耷|疸|妲|怛|靼|笪',
		'dai'       => '带|代|玳|戴|待|贷|袋|呆|岱|傣|黛|甙|逮|埭|殆|歹|绐|骀|迨|绐|怠|呔',
		'dan'       => '单|弹|掸|殚|惮|郸|瘅|箪|旦|但|担|胆|疸|丹|蛋|淡|啖|赕|氮|诞|儋|澹|耽|石|萏|眈|聃',
		'dang'      => '当|挡|档|铛|裆|谠|党|荡|砀|宕|菪|凼',
		'dao'       => '岛|捣|到|道|倒|刀|叨|忉|导|盗|稻|蹈|悼|焘|祷|帱|氘|纛',
		'de'        => '的|得|锝|德|地',
		'deng'      => '邓|灯|登|澄|蹬|瞪|嶝|凳|噔|簦|镫|磴|戥|等',
		'di'        => '帝|蒂|谛|缔|碲|弟|绨|娣|递|睇|第|地|氐|低|底|抵|坻|诋|砥|柢|骶|羝|堤|提|迪|滴|嘀|镝|嫡|敌|邸|狄|荻|棣|笛|涤|的|嶂|觌|籴',
		'dian'      => '店|掂|惦|踮|点|坫|玷|电|垫|碘|典|淀|靛|殿|癜|甸|滇|巅|颠|癫|奠|佃|钿|簟|皲|堤|岸',
		'diao'      => '调|雕|凋|鲷|碉|掉|刁|叼|吊|铞|钓|貂|铫|鸟',
		'die'       => '谍|蹀|碟|蝶|牒|鲽|喋|揲|堞|跌|叠|迭|耋|瓞|垤',
		'ding'      => '定|锭|腚|碇|啶|丁|订|盯|钉|仃|叮|町|酊|玎|耵|顶|疔|鼎|铤',
		'diu'       => '丢|铥',
		'dong'      => '动|东|栋|冻|胨|岽|鸫|洞|胴|峒|硐|侗|恫|垌|冬|咚|氡|董|懂',
		'dou'       => '都|斗|抖|蚪|豆|逗|痘|兜|篼|蔸|陡|窦|读',
		'du'        => '渎|读|牍|犊|椟|黩|度|渡|镀|杜|肚|毒|独|睹|赌|堵|都|嘟|嘟|督|笃|蠹|妒|黢|髑|顿|芏',
		'duan'      => '段|锻|缎|煅|椴|断|簖|短|端',
		'dui'       => '对|怼|队|堆|碓|兑|敦|镦|憝',
		'dun'       => '吨|顿|钝|盹|炖|砘|沌|囤|敦|墩|礅|镦|盾|遁|蹲|趸',
		'duo'       => '多|哆|夺|驮|朵|垛|躲|跺|铎|剁|哚|舵|柁|度|踱|咄|堕|惰|掇|裰|缍|沲',
		
		'e'         => '锷|鄂|鳄|鹗|萼|谔|腭|愕|颚|额|俄|饿|娥|峨|鹅|蛾|哦|锇|莪|阿|婀|屙|恶|噩|垩|厄|扼|苊|轭|呃|阏|遏|讹',
		'en'        => '恩|摁|蒽',
		'er'        => '二|而|鸸|鲕|尔|迩|儿|耳|洱|饵|铒|珥|佴|贰',
		
		'fa'        => '发|法|砝|珐|伐|阀|筏|垡|乏|罚',
		'fan'       => '反|贩|饭|返|畈|凡|帆|矾|钒|梵|番|翻|藩|幡|燔|蹯|蕃|范|犯|樊|繁|蘩|泛|烦',
		'fang'      => '方|放|房|防|芳|访|纺|仿|坊|邡|舫|枋|妨|钫|肪|鲂|钫|彷',
		'fei'       => '费|沸|狒|镄|狒|飞|废|肥|淝|非|菲|啡|扉|诽|腓|痱|榧|悱|鲱|绯|匪|篚|斐|翡|蜚|霏|吠|妃|芾|肺',
		'fen'       => '分|份|粉|汾|纷|酚|玢|吩|鼢|芬|棼|忿|氛|坟|奋|态|粪|愤|鲼|偾|焚|瀵',
		'feng'      => '风|疯|讽|砜|枫|封|葑|丰|沣|冯|峰|锋|蜂|烽|逢|缝|奉|俸|唪|凤|酆',
		'fo'        => '佛',
		'fou'       => '否|缶',
		'fu'        => '富|副|福|幅|辐|蝠|匐|抚|赴|讣|夫|扶|肤|蚨|呋|芙|趺|麸|蚨|负|复|蝮|腹|鳆|馥|覆|服|付|府|附|俯|鲋|驸|跗|符|苻|孚|莩|浮|俘|郛|桴|咐|拊|腑|蜉|孵|腐|稃|阜|妇|伏|袱|茯|父|斧|釜|滏|甫|傅|辅|脯|黼|赙|缚|敷|弗|佛|拂|砩|怫|绋|艴|氟|绂|绂|祓|黻|黻|赋|涪|罘|芾|疠|凫|菔|幞',
		
		'ga'        => '嘎|噶|旮|伽|咖|胳|轧|钆|尕|尜|尬|夹',
		'gai'       => '该|改|盖|丐|钙|概|溉|赅|陔|垓|芥|戤',
		'gan'       => '干|杆|肝|秆|矸|酐|擀|竿|敢|橄|澉|赶|甘|柑|坩|泔|旰|绀|苷|疳|感|赣|乾|淦|尴',
		'gang'      => '冈|钢|刚|纲|岗|缸|扛|杠|肛|罡|港|筻|戆',
		'gao'       => '稿|高|搞|镐|缟|槁|藁|篙|告|郜|锆|诰|膏|糕|羔|杲|皋|槔|睾',
		'ge'        => '个|格|铬|胳|各|硌|骼|袼|咯|阁|搁|仡|虼|圪|纥|屹|疙|鬲|隔|镉|嗝|膈|塥|哿|舸|哥|歌|革|葛|割|盖|戈|合|蛤|鸽|搿|颌',
		'gei'       => '给',
		'gen'       => '艮|根|跟|茛|哏|亘',
		'geng'      => '更|梗|埂|绠|鲠|哽|耕|庚|耿|赓|羹|颈',
		'gong'      => '共|供|拱|珙|恭|工|巩|红|贡|汞|攻|公|功|宫|龚|弓|躬|觥|蚣|肱',
		'gou'       => '句|够|狗|佝|笱|苟|枸|岣|勾|构|购|沟|钩|垢|诟|觏|鞲|媾|遘|篝|缑|彀',
		'gu'        => '股|古|故|估|姑|沽|钴|鸪|咕|蛄|诂|牯|酤|罟|菇|轱|固|锢|鲴|崮|痼|嘏|梏|鹄|顾|谷|骨|鹘|鼓|臌|雇|辜|孤|觚|呱|菰|贾|汩|箍|蛊|瞽|毂|汨',
		'gua'       => '挂|诖|卦|褂|瓜|呱|胍|刮|寡|括|剐|鸹',
		'guai'      => '怪|拐|乖|掴',
		'guan'      => '关|官|馆|棺|倌|涫|管|观|冠|莞|灌|罐|贯|惯|掼|鳏|纶|鹳|盥|矜',
		'guang'     => '广|犷|光|咣|胱|桄|逛',
		'gui'       => '妫|贵|归|轨|圭|桂|硅|鲑|闺|鬼|傀|瑰|龟|柜|规|炔|炅|跪|诡|癸|獬|庋|宄|匦|刿|刽|簋|桧|晷|皈|鳜',
		'gun'       => '衮|滚|磙|棍|辊|绲|鲧',
		'guo'       => '过|国|帼|蝈|掴|郭|果|猓|蜾|呙|涡|埚|锅|虢|裹|椁|崞|馘|聒',
		
		'ha'        => '哈|蛤|铪|虾',
		'hai'       => '还|海|害|孩|亥|氦|咳|嗨|骇|嘿|醢|胲|骸',
		'han'       => '韩|蚶|邯|酣|汉|含|焓|喊|憾|撼|寒|汗|犴|鼾|邗|顸|罕|旱|焊|捍|悍|撖|憨|函|涵|翰|瀚|阚|颔|菡|晗',
		'hang'      => '行|珩|绗|航|杭|吭|沆|巷|夯|颃',
		'hao'       => '号|好|浩|耗|郝|豪|皓|毫|昊|蒿|壕|濠|蚝|嚎|貉|颢|嗥|嚆|镐|薅',
		'he'        => '和|河|何|呵|诃|蚵|嗬|荷|菏|合|盒|颌|核|劾|阂|曷|喝|褐|鹤|贺|赫|禾|壑|阖|涸|吓|纥|貉|盍|翮',
		'hei'       => '黑|嘿|嗨',
		'hen'       => '很|恨|狠|痕',
		'heng'      => '恒|横|亨|哼|行|珩|桁|衡|蘅',
		'hong'      => '哄|洪|烘|红|虹|讧|荭|宏|闳|鸿|轰|弘|泓|訇|蕻|黉|薨|疫',
		'hou'       => '后|逅|骺|侯|候|猴|喉|堠|糇|篌|瘊|厚|吼|後|鲎',
		'hu'        => '户|护|沪|戽|扈|胡|湖|糊|瑚|鹕|煳|醐|猢|蝴|葫|虎|唬|滹|琥|互|乎|呼|轷|烀|狐|弧|瓠|壶|忽|笏|惚|唿|浒|核|囫|鹄|祜|怙|岵|和|鹱|斛|槲|冱|戏|鹘|觳',
		'hua'       => '划|化|华|骅|哗|铧|桦|花|画|话|滑|猾|豁|砉',
		'huai'      => '怀|坏|淮|槐|踝|徊|划',
		'huan'      => '欢|环|还|擐|缳|圜|寰|奂|换|焕|涣|唤|痪|患|漶|桓|洹|郇|缓|锾|幻|宦|浣|鲩|逭|鬟|豢|萑',
		'huang'     => '黄|蟥|潢|璜|磺|簧|癀|荒|慌|谎|皇|湟|煌|蝗|惶|徨|隍|凰|鳇|篁|遑|恍|晃|幌|肓',
		'hui'       => '汇|匹|会|绘|烩|桧|浍|荟|回|洄|蛔|徊|茴|辉|挥|晖|珲|惠|蟪|蕙|毁|彗|慧|灰|恢|诙|咴|悔|晦|诲|溃|缋|贿|麾|堕|卉|秽|哕|徽|讳|喙|虺|恚|隳',
		'hun'       => '混|馄|昏|阍|婚|浑|荤|珲|诨|溷|魂',
		'huo'       => '或|惑|后|活|获|货|火|伙|钬|和|霍|嚯|藿|攉|祸|豁|夥|劐|镬|蠖|耠|锪',
		
		'ji'        => '几|机|饥|矶|叽|肌|玑|讥|虮|及|圾|极|圾|汲|级|芨|笈|岌|己|记|纪|鸡|基|计|集|际|齐|济|挤|剂|跻|荠|霁|哜|鲚|吉|佶|诘|咭|髻|继|系|急|积|季|悸|冀|籍|藉|技|伎|妓|芰|屐|击|暨|绩|姬|箕|稽|蓟|给|寄|奇|畸|犄|掎|迹|疾|蒺|忌|跽|激|祭|辑|缉|楫|骥|寂|脊|瘠|嵴|期|稷|棘|鲫|嵇|羁|麂|戟|戢|蕺|革|其|亟|殛|洎|觊|笄|齑|偈|赍|即|既|唧|乩|丌|墼|剞|畿|嫉',
		'jia'       => '家|嫁|稼|镓|嘉|价|加|伽|珈|枷|跏|架|驾|笳|假|茄|痂|袈|迦|嘏|瘕|葭|佳|甲|钾|胛|岬|贾|夹|郏|蛱|铗|浃|颊|荚|戛|袷|恝',
		'jian'      => '件|建|健|键|腱|踺|毽|楗|犍|间|涧|锏|裥|简|见|枧|舰|笕|减|碱|缄|兼|缣|搛|蒹|鹣|检|剑|捡|俭|硷|睑|肩|监|槛|尖|坚|菅|蹇|渐|鉴|剪|翦|箭|湔|煎|谫|拣|歼|茧|荐|鞯|柬|谏|戋|浅|饯|贱|践|溅|笺|奸|艰|謇|戬|僭|鲣|囝|趼|牮',
		'jiang'     => '江|豇|虹|茳|将|奖|浆|桨|酱|蒋|强|糨|犟|降|洚|绛|讲|姜|疆|僵|缰|礓|匠|耩',
		'jiao'      => '交|较|胶|皎|敫|蛟|绞|郊|姣|跤|饺|佼|狡|铰|校|鲛|茭|侥|浇|叫|教|脚|缴|徼|角|焦|礁|醮|噍|鹪|僬|蕉|觉|搅|矫|娇|轿|骄|挢|峤|窖|椒|嚼|剿|艽|湫|纟|酵',
		'jie'       => '届|孑|节|疖|借|街|杰|接|解|结|洁|秸|诘|鲒|桔|拮|皆|喈|楷|戒|截|诫|捷|婕|睫|揭|羯|偈|竭|碣|阶|介|价|蚧|芥|疥|骱|界|姐|劫|藉|家|颉|嗟|桀|讦',
		'jin'       => '金|仅|进|尽|烬|赆|荩|锦|津|斤|靳|近|晋|缙|今|衿|妗|矜|劲|紧|禁|襟|噤v巾|浸|堇|谨|瑾|槿|馑|廑|筋|卺|觐',
		'jing'      => '竞|竟|境|镜|獍|泾|经|劲|刭|颈|径|弪|茎|迳|痉|井|阱|肼|精|靖|腈|睛|婧|靓|静|菁|净|景|憬|京|惊|鲸|敬|警|荆|晶|兢|儆|旌|粳',
		'jiong'     => '窘|迥|炯|扃|炅',
		'jiu'       => '就|僦|蹴|纠|赳|九|旧|酒|久|疚|玖|救|究|柩|灸|揪|啾|鬏|臼|桕|舅|咎|鹫|鸠|厩|韭|阄',
		'ju'        => '局|居|据|椐|踞|倨|琚|裾|锯|巨|拒|距|炬|矩|柜|钜|讵|苣|榘|句|驹|拘|枸|锔|具|俱|犋|惧|飓|举|榉|剧|聚|菊|鞠|掬|且|咀|雎|龃|沮|趄|狙|苴|疽|遽|踽|瞿|醵|莒|屦|窭|橘|鞫|桔|车',
		'juan'      => '卷|倦|锩|圈|眷|桊|捐|娟|绢|涓|狷|隽|镌|俊|鹃|鄄|蠲',
		'jue'       => '决|觖|诀|抉|绝|孓|觉|角|桷|掘|倔|崛|珏|爵|嚼|爝|厥|劂|撅|蕨|橛|镢|噘|蹶|獗|矍|谲|噱|攫|脚|嗟',
		'jun'       => '钧|均|筠|军|皲|俊|峻v骏|浚|竣|君|郡|捃|菌|龟|麇|隽',
		
		'ka'        => '卡|咔|胩|佧|喀|咯|咖',
		'kai'       => '开|锎|凯|恺|铠|垲|剀|楷|揩|锴|蒈|慨|忾',
		'kan'       => '考|烤|铐|栲|拷|靠|犒|尻',
		'kang'      => '坎|砍|嵌|莰|看|刊|槛|侃|堪|勘|阚|瞰|龛|戡',
		'kao'       => '亢|炕|抗|伉|钪|闶|糠|慷|康|扛',
		'ke'        => '可|柯|珂|坷|轲|蚵|钶|苛|岢|疴|克|氪|科|蝌|客|颗|棵|课|髁|锞|稞|骒|窠|刻|咳|颏|磕|嗑|瞌|溘|壳|渴|恪|缂',
		'ken'       => '肯|啃|垦|恳|龈|裉',
		'keng'      => '坑|吭|铿',
		'kong'      => '空|控|崆|倥|箜|孔|恐',
		'kou'       => '口|扣|筘|叩|寇|蔻|抠|眍|芤',
		'ku'        => '库|裤|枯|酷|骷|苦|哭|堀|窟|绔|刳|喾',
		'kua'       => '夸|挎|跨|垮|胯|侉',
		'kuai'      => '筷|快|块|会|浍|郐|侩|狯|哙|脍|蒯',
		'kuan'      => '款|宽|髋',
		'kuang'     => '矿|旷|邝|纩|圹|匡|框|眶|哐|诓|筐|狂|诳|况|贶|夼',
		'kui'       => '亏|奎|跬|喹|蝰|隗|愧|傀|魁|夔|睽|揆|葵|愦|溃|馈|聩|篑|蒉|匮|窥|逵|馗|喟|盔|悝|暌|岿',
		'kun'       => '困|捆|悃|阃|昆|琨|锟|鲲|醌|坤|髡',
		'kuo'       => '括|蛞|栝|适|阔|扩|廓',
		
		'la'        => '拉|砬|垃|啦|喇|腊|蜡|落|剌|辣|旯|邋|瘌',
		'lai'       => '来|莱|睐|铼|徕|崃|涞|赉|赖|濑|籁|癞',
		'lan'       => '兰|栏|烂|拦|蓝|滥|篮|褴|岚|览|揽|缆|榄|阑|谰|镧|斓|懒|婪|漤|罱',
		'lang'      => '狼|浪|郎|朗|琅|锒|稂|榔|螂|啷|廊|阆|莨|蒗',
		'lao'       => '老|姥|佬|栳|铑|劳|捞|涝|崂|唠|耢|铹|痨|牢|烙|络|酪|落|醪|潦',
		'le'        => '了|叻|仂|肋|泐|勒|鳓|乐',
		'lei'       => '垒|类|雷|蕾|擂|镭|檑|累|嫘|缧|勒|嘞|泪|肋|磊|羸|耒|诔|酹|儡',
		'leng'      => '愣|楞|塄|棱|冷',
		'li'        => '丽|鹂|郦|骊|俪|鲡|逦|厉|疠|粝|励|呖|雳|砺|蛎|力|历|沥|坜|枥|苈|疬|砾|栎|轹|跞|里|理|哩|喱|狸|鲤|锂|俚|悝|厘|娌|李|利|俐|蜊|猁|梨|犁|莉|痢|立|粒|莅|笠|离|缡|漓|璃|篱|蓠|礼|黎|藜|例|栗|溧|傈|篥|荔|澧|醴|鳢|罹|蠡|吏|隶|鬲|戾|唳|嫠|詈|黧',
		'lian'      => '联|连|莲|链|裢|涟|琏|鲢|练|炼|脸|殓|敛|裣|潋|蔹|帘|怜|廉|濂|蠊|臁|镰|恋|楝|奁',
		'liang'     => '两|辆|俩|魉|量|良|粮|踉|莨|梁|粱|墚|亮|凉|晾|谅|椋|靓',
		'liao'      => '了|辽|疗|钌|料|寥|廖|蓼|聊|撂|撩|僚|燎|镣|潦|缭|獠|嘹|鹩|寮',
		'lie'       => '猎|列|咧|洌|冽|烈|裂|趔|劣|鬣|躐|捩|埒',
		'lin'       => '林|琳|淋|啉|霖|临|鳞|麟|磷|膦|辚|瞵|嶙|粼|遴|邻|吝|蔺|赁|廪|檩|凛|懔|躏|拎',
		'ling'      => '令|岭|领|龄|铃|玲|拎|伶|羚|泠|呤|蛉|聆|柃|瓴|翎|苓|零|囹|灵|棂|另|陵|菱|凌|绫|鲮|棱',
		'liu'       => '刘|浏|六|留|溜|榴|骝|熘|馏|镏|瘤|遛|流|硫|琉|旒|锍|鎏|柳|陆|鹨|绺|碌',
		'lo'        => '咯',
		'long'      => '龙|拢|陇|胧|珑|咙|泷|栊|茏|笼|垄|砻|聋|隆|窿|癃|弄|哢',
		'lou'       => '娄|楼|搂|喽|镂|髅|耧|偻|蝼|嵝|蒌|篓|瘘|漏|陋|露',
		'lu'        => '路|潞|璐|露|鹭|陆|卢|泸|炉|鲈|栌|舻|垆|胪|颅|鸬|轳|驴|庐|芦|卤|硵|录|绿|禄|碌|渌|逯|鲁|橹|噜|镥|撸|氇|鹿|麓|辘|漉|簏|戮|虏|掳|辂|赂|蓼|六',
		'luan'      => '栾|滦|鸾|銮|峦|娈|孪|挛|脔|乱|卵',
		'lun'       => '仑|轮|论|轮|纶|伦|抡|沦|囵',
		'luo'       => '罗|锣|椤|猡|萝|箩|逻|跞|泺|洛|络|硌|骆|珞|烙|雒|落|漯|摞|螺|骡|镙|瘰|裸|倮|荦|脶',
		'lü'        => '律|率|绿|氯|吕|侣|铝|闾|稆|旅|膂|虑|履|缕|偻|褛|屡|捋',
		'lüe'       => '略|掠|锊',

		'ma'        => '马|吗|蚂|玛|码|妈|犸|杩|骂|麻|嘛|摩|嬷|蟆|么|抹|呒|唛',
		'mai'       => '买|卖|荬|麦|迈|劢|埋|霾|脉',
		'mao'       => '毛|牦|耄|髦|旄|贸|锚|猫|茂|冒|帽|瑁|矛|茅|袤|蟊|蝥|瞀|懋|卯|铆|泖|茆|峁|貌|昴',
		'man'       => '曼|慢|漫|鳗|幔|馒|熳|镘|墁|谩|缦|蔓|满|瞒|螨|颟|蛮|埋|鞔',
		'mang'      => '忙|邙|氓|芒|茫|硭|莽|蟒|漭|盲',
		'me'        => '麽',
		'mei'       => '每|梅|酶|莓|霉|没|美|镁|煤|媒|枚|妹|昧|魅|眉|湄|媚|楣|猸|鹛|嵋|镅|玫|寐|袂|糜|谜|浼',
		'men'       => '门|们|闷|扪|钔|焖|懑',
		'meng'      => '孟|猛|锰|蜢|勐|艋|梦|蒙|檬|朦|盟|萌|懵|氓',
		'mi'        => '米|迷|咪|谜|眯|脒|醚|敉|麋|泌|秘|谧|宓|密|蜜|嘧|弥|祢|猕|糜|靡|縻|蘼|芈|觅|汨|弭|幂',
		'mian'      => '苗|瞄|描|喵|鹋|庙|秒|妙|杪|眇|渺|缈|缪|淼|邈|藐',
		'miao'      => '面|缅|腼|湎|棉|绵|免|勉|娩|冕|丐|沔|眄|眠|黾|渑',
		'mie'       => '灭|蔑|篾|蠛|咩|乜',
		'min'       => '民|泯|珉|岷|抿|苠|缗|敏|玟|闽|闵|悯|愍|黾|鳘|皿',
		'ming'      => '名|铭|酩|茗|明|盟|鸣|命|冥|溟|瞑|暝|螟',
		'miu'       => '谬|缪',
		'mo'        => '末|抹|沫|秣|摸|莫|模|膜|馍|谟|漠|镆|嫫|貘|瘼|寞|蓦|摹|没|殁|墨|耱|嬷|麽|磨|摩|蘑|魔|默|脉|万|茉|陌|貊|冒|嘿|貉|无',
		'mou'       => '某|谋|牟|眸|哞|侔|蛑|缪|鍪|蝥',
		'mu'        => '木|亩|牧|母|姆|拇|坶|目|钼|苜|幕|墓|慕|募|暮|模|沐|穆|睦|牡|姥|仫|牟|毪',
		
		'na'        => '那|哪|娜|拿|镎|纳|钠|呐|衲|肭|捺|呢|南',
		'nai'       => '耐|乃|奶|艿|氖|佴|奈|柰|萘|鼐|哪',
		'nan'       => '南|楠|喃|蝻|腩|难|男|囡|囝|赧',
		'nang'      => '囊|曩|馕|囔|攮',
		'nao'       => '脑|恼|垴|瑙|硇|闹|铙|挠|蛲|淖|孬|猱|呶',
		'ne'        => '呢|哪|讷|呐',
		'nei'       => '内|馁|那|哪',
		'nen'       => '嫩|恁',
		'neng'      => '能',
		'ni'        => '你|祢|尼|妮|泥|呢|坭|铌|昵|伲|怩|旎|拟|倪|鲵|睨|猊|霓|逆|腻|溺|匿|慝',
		'nian'      => '年|念|捻|埝|鲶|粘|拈|鲇|黏|碾|廿|撵|蔫|辇',
		'niang'     => '娘|酿',
		'niao'      => '鸟|袅|茑|尿|脲|溺|嬲',
		'nie'       => '聂|嗫|颞|蹑|镊|乜|捏|涅|陧|臬|镍|孽|蘖|啮',
		'nin'       => '您|恁',
		'ning'      => '宁|拧|柠|泞|咛|聍|狞|苎|凝|佞|甯',
		'niu'       => '牛|妞|扭|钮|纽|忸|狃|拗',
		'nong'      => '农|浓|侬|哝|脓|弄|廾',
		'nou'       => '耨',
		'nu'        => '奴|怒|努|弩|胬|驽|孥',
		'nuan'      => '暖',
		'nuo'       => '挪|娜|诺|锘|喏|傩|糯|懦|搦',
		'nü'        => '女|钕|衄|恧',
		'nüe'       => '虐|疟',

		'ou'        => '区|欧|瓯|鸥|殴v沤呕|怄|讴|偶|耦|藕',

		'pa'        => '怕|帕|啪|杷|钯|耙|爬|筢|琶|葩|扒|趴|派',
		'pai'       => '牌|派|哌|蒎|排|俳|徘|湃|拍|迫',
		'pan'       => '盘|番|潘|蟠|判|泮|畔|胖|袢|攀|襻|拚|盼|叛|扳|般|磐|爿|蹒',
		'pang'      => '旁|滂|磅|膀|螃|耪|乓|庞|胖|逄|彷',
		'pao'       => '跑|炮|泡|袍|匏|咆|狍|刨|疱|庖|抛|脬',
		'pei'       => '配|培|陪|赔|醅|锫|沛|旆|霈|佩|裴|胚|呸|辔|帔',
		'pen'       => '喷|盆|湓',
		'peng'      => '碰|彭|澎|膨|嘭|蟛|朋|鹏|棚|堋|捧|蓬|篷|硼|怦|砰|抨|烹',
		'pi'        => '批|枇|毗|仳|吡|纰|蚍|砒|琵|庀|屁|芘|皮|披|陂|铍|疲|丕|邳|坯|坏|否|痞|匹|劈|啤|脾|裨|蜱|睥|陴|郫v埤|淠|辟|僻|癖|噼|擗|霹|甓|譬|媲|貔|堡|疋|圮|罴|鼙',
		'pian'      => '片|扁|偏|骗|犏|蹁|谝|翩|篇|骈|胼|便|缏',
		'piao'      => '票|漂|螵|骠|缥|嘌|嫖|瞟|飘|瓢|剽|莩|殍|朴',
		'pie'       => '撇|瞥|氕|苤',
		'pin'       => '拼|姘|品|榀|聘|贫|频|拚|颦|嫔|苹|牝',
		'ping'      => '瓶|平|评|坪|鲆|枰|苹|萍|凭|屏|乒|俜|娉|冯',
		'po'        => '破|坡|颇|陂|婆|繁|迫|泼|魄|泊|粕|珀|朴|钋|皤|鄱|叵|笸|钷|攴|泺|钹',
		'pou'       => '剖|掊|瓿|裒',
		'pu'        => '铺|浦|溥|埔|脯|莆|蒲|圃|匍|葡|普|谱|镨|氆|扑|朴|仆|濮|璞|蹼|噗|镤|暴|瀑|曝|堡|菩',

		'qi'        => '奇|骑|绮|崎|琦|欹|其|期|旗|棋|琪|祺|淇|麒|骐|蜞|欺|萁|葺|七|气|汽|齐|蛴|脐|荠|企|器|启|岐|妻|萋|凄|弃|蕲|祁|乞|汔|迄|讫|亓|祈|圻|漆|戚|槭|嘁|杞|屺|岂|桤|芑|起|砌|沏|歧|栖|泣|契|芪|憩|耆|鳍|畦|稽|蹊|碛|綦|俟|颀|綮|缉|亟|柒',
		'qia'       => '卡|恰|洽|掐|髂|葜',
		'qian'      => '佥|签|前|钱|浅|千|钎|阡|纤|扦|仟|迁|芊|欠|肷|歉|芡|潜|黔|钤|铅|乾|牵|谦|慊|倩|嵌|遣|谴|缱|钳|箝|茜|骞|褰|搴|掮|堑|鬈|椠|愆|荨|悭|犍|岍|虔',
		'qiang'     => '呛|枪|抢|炝|跄|羌|蜣|强|襁|镪|墙|嫱|樯|蔷|腔|戕|戗|锖|将|锵|羟|蕉',
		'qiao'      => '乔|桥|侨|峤|鞒|荞|俏|悄|峭|鞘|诮|巧|窍|瞧|樵|憔|劁|谯|雀|蕉|敲|翘|橇|撬|壳|锹|愀|跷|硗|缲',
		'qie'       => '且|趄|切|窃|砌|郄|伽|茄|锲|妾|挈|怯|慊|惬|箧',
		'qin'       => '衾|秦|溱|螓|嗪|亲|矜|琴|芩|沁|吣|禽|噙|擒|檎|侵|寝|锓|芹|钦|揿|覃|勤|廑',
		'qing'      => '青|清|请|情|晴|蜻|鲭|箐|氰|圊|顷|倾|倾|轻|氢|罄|磬|謦|庆|卿|亲|綮|苘|檠|黥|黧',
		'qiong'     => '穷|穹|邛|筇|蛩|銎|跫|琼|茕',
		'qiu'       => '求|球|俅|赇|逑|裘|秋|鳅|楸|湫|丘|邱|蚯|仇|鼽|犰|酋|遒|蝤|囚|泅|虬|巯|糗|龟',
		'qu'        => '区|驱|躯|岖|去|祛|取|曲|蛐|趋|渠|屈|瞿|蠼|衢|氍|癯|璩|蘧|麴|趣|娶|蛆|觑|朐|劬|龋|阒|鸲|磲|苣|蕖|诎|戌|黢',
		'quan'      => '全|诠|铨|醛|辁|荃|筌|痊|权|泉|劝|券|拳|蜷|绻|圈|犬|畎|颧|悛|鬈',
		'que'       => '阙|却|缺|炔|确|雀|鹊|瘸|榷|阕|悫',
		'qun'       => '裙|群|麇|逡',

		'ran'       => '染|然|燃|冉|苒|蚺|髯',
		'rang'      => '让|嚷|壤|攘|穰|禳|瓤',
		'rao'       => '绕|饶|桡|娆|荛|扰',
		're'        => '热|若|喏|惹',
		'ren'       => '人|认|壬|任|饪|衽|妊|荏|仁|刃|韧|轫|纫|仞|忍|稔|葚',
		'reng'      => '仍|扔',
		'ri'        => '日',
		'rong'      => '容|溶|熔|榕|蓉|融|戎|绒|狨|荣|嵘|蝾|茸|冗|肜',
		'rou'       => '肉|柔|揉|鞣|蹂|糅',
		'ru'        => '如|洳|铷|茹|入|汝|儒|濡|嚅|蠕|颥|襦|孺|薷|乳|辱|褥|溽|缛|蓐',
		'ruan'      => '软|阮|朊',
		'rui'       => '瑞|芮|枘|蚋锐|睿|蕊|蕤',
		'run'       => '闰|润',
		'ruo'       => '弱|若|箬|偌',
		
		'sa'        => '洒|萨|撒|卅|飒|仨|挲|脎',
		'sai'       => '塞|噻|赛|思|腮|鳃',
		'san'       => '三|散|馓|霰|伞|叁|糁|毵',
		'sang'      => '桑|嗓|搡|磉|颡',
		'sao'       => '扫|埽|嫂|骚|搔|鳋|瘙|缲|臊|缫|梢',
		'se'        => '色|铯|瑟|塞|涩|啬|穑',
		'sen'       => '森',
		'seng'      => '僧',
		'sha'       => '沙|纱|砂|莎|痧|鲨|裟|挲|杀|刹|铩|啥|厦|嗄|傻|唼|煞|霎|杉|歃',
		'shai'      => '晒|筛|色|酾',
		'shan'      => '山|汕|讪|舢|疝|善|鄯|膳|鳝|缮|蟮|单|禅|掸|陕|闪|扇|煽|骟|衫|杉|髟|钐|珊|删|姗|跚|栅|擅|膻|嬗|潸|芟|赡|剡|掺|苫|埏',
		'shang'     => '上|商|墒|熵|绱|尚|晌|垧|伤|汤|觞|殇|裳|赏',
		'shao'      => '少|烧|召|绍|韶|邵|劭|苕|稍|哨|捎|鞘|梢|潲|蛸|艄|筲|勺|杓|芍',
		'she'       => '设|社|蛇|舌|舍|猞|射|麝|涉|佘|赊|畲|折|厍|摄|慑|滠|奢|歙|赦|揲',
		'shei'      => '谁',
		'shen'      => '深|身|沈|神|砷|甚|椹|葚|绅|申|审|伸|胂|呻|砷|婶|渖|慎|莘|渗|参|糁|肾|矧|蜃|哂|谂|诜|娠',
		'sheng'     => '生|胜|牲|笙|眚|省|声|升|盛|晟|圣|绳|渑|乘|剩|嵊|甥',
		'shi'       => '是|市|柿|铈|师|饰|十|士|仕|什|使|时|鲥|埘|莳|事|式|拭|试|轼|弑|石|炻|史|驶|室|世|视|实|诗|峙|侍|恃|施|氏|势|始|食|失|识|狮|示|湿|适|释|尸|拾|似|逝|誓|蚀|矢|屎|螫|嗜|蓍|筮|噬|虱|鲺|匙|谥|贳|酾|殖|嘘|豕|舐',
		'shou'      => '手|收|首|售|守|狩|寿|受|授|瘦|绶|兽|艏|熟',
		'shu'       => '数|书|树|属|术|沭|秫|述|熟|输|腧|毹|叔|淑|菽|暑|署|曙|薯|鼠|舒|抒|纾|束|殳|疏|蜀|孰|恕|竖|殊|姝|枢|梳|蔬|戍|漱|澍|赎|倏|庶|墅|塾|摅|黍',
		'shua'      => '耍|刷|唰',
		'shuai'     => '率|摔|蟀|甩|帅|衰',
		'shuan'     => '拴|栓|涮|闩',
		'shuang'    => '双|爽|霜|孀|泷',
		'shui'      => '水|税|谁|睡|说',
		'shun'      => '顺|舜|瞬|吮',
		'shuo'      => '说|朔|搠|槊|蒴|硕|数|烁|铄|妁',
		'si'        => '四|泗|驷|斯|撕|嘶|澌|死|司|饲|嗣|伺|笥|思|锶|缌|丝|咝|似|寺|私|姒|俟|厮|肆|巳|祀|汜|蛳|兕|耜|鸶|厶|食|厕',
		'song'      => '送|宋|颂|嵩|松|讼|忪|凇|淞|崧|菘|耸|诵|悚|竦|怂',
		'sou'       => '叟|搜|嗖|锼|溲|馊|艘|瞍|螋|飕|擞|薮|嗾|嗽',
		'su'        => '苏|诉|素|愫|嗉|涑|觫|速|溯|塑|粟|僳|宿|缩|俗|肃|酥|簌|蔌|夙|稣|谡',
		'suan'      => '算|酸|蒜|狻',
		'sui'       => '岁|虽|随|隋|髓|睢|眭|濉|穗|遂|隧|燧|碎|绥|荽|祟|谇|尿',
		'sun'       => '孙|狲|荪|损|笋|榫|隼|飧',
		'suo'       => '所|索|嗦|唢|锁|琐|缩|梭|睃|羧|唆|莎|桫|娑|挲|嗍|蓑',
		
		'ta'        => '她|他|它|塔|嗒|沓|踏|塌|榻|蹋|鳎|溻|遢|獭|漯|趿|挞|闼|拓|铊',
		'tai'       => '台|抬|胎|跆|骀|鲐|邰|苔|炱|太|汰|肽|酞|呔|钛|态|泰|薹',
		'tan'       => '摊|滩|瘫|坛|覃|谭|潭|镡|探|弹|檀|贪|坦|袒|钽|谈|锬|郯|碳|炭|毯|痰|叹|忐|坍|澹|昙',
		'tang'      => '唐|糖|塘|搪|瑭|溏|醣|螗|堂|膛|镗|樘|螳|饧|汤|铴|烫|棠|淌|倘|躺|耥|惝|趟|羰|傥|帑',
		'tao'       => '讨|套|涛|焘|陶|掏|淘|啕|萄|逃|桃|洮|韬|叨|滔|绦|鼗|饕',
		'te'        => '特|忑|忒|铽|慝',
		'teng'      => '滕|藤|誊|腾|疼',
		'ti'        => '体|提|醍|缇|题|嚏|替|梯|锑|踢|裼|惕|剔|蹄|屉|啼|涕|悌|绨|剃|鹈|倜|逖|荑',
		'tian'      => '天|田|钿|佃|畋|填|忝|添|舔|掭|甜|恬|腆|阗|殄',
		'tiao'      => '跳|挑|眺|佻|祧|窕|调|迢|龆|苕|髫|笤|条|鲦|粜|蜩',
		'tie'       => '铁|贴|帖|萜|餮',
		'ting'      => '厅|听|廷|挺|艇|铤|蜓|梃|庭|莛|霆|亭|停|婷|葶|汀|町|烃',
		'tong'      => '同|铜|桐|侗|酮|恫|峒|垌|筒|茼|通|桶|捅|痛|嗵|童|潼|僮|瞳|统|仝|砼|彤|佟|恸',
		'tou'       => '头|投|骰|透|偷|钭',
		'tu'        => '图|土|吐|钍|屠|涂|酴|途|荼|徒|兔|堍|菟|突|秃|凸',
		'tuan'      => '抟|团|疃|彖|湍',
		'tui'       => '退|腿|褪|煺|推|颓|蜕|忒',
		'tun'       => '屯|饨|囤|吞|豚|臀|褪|氽|暾',
		'tuo'       => '拖|乇|托|脱|拓|庹|陀|沱|驼|坨|砣|跎|柁|酡|铊|舵|佗|鸵|妥|驮|魄|箨|橐|柝|椭|鼍|唾',
		
		'wa'        => '瓦|佤|娃|洼|哇|蛙|挖|袜|娲|凹|腽',
		'wai'       => '外|歪|崴',
		'wan'       => '万|完|玩|皖|脘|顽|烷|莞|弯|湾|宛|碗|婉|琬|腕|畹|豌|蜿|剜|惋|菀|晚|挽|娩|丸|纨|芄|绾',
		'wang'      => '王|汪|旺|枉|往|望|亡|忘|芒|网|罔|辋|惘|魍|妄|尢',
		'wei'       => '为|伪|沩|维|唯|惟|潍|位|未|味|委|诿|逶|萎|痿|微|薇|威|葳|崴|卫|尾|娓|艉|危|魏|巍|嵬|韦|伟|纬|玮|炜|帏|苇|违|韪|围|涠|闱|尉|慰|蔚|畏|猥|隗|喂|偎|煨|隈|胃|谓|渭|猬|圩|帷|桅|遗|鲔|洧',
		'wen'       => '问|文|纹|蚊|汶|雯|温|瘟|闻|稳|吻|刎|璺|紊|阌',
		'weng'      => '翁|瓮|嗡|蓊|蕹',
		'wo'        => '我|硪|涡|蜗|窝|莴|握|渥|龌|喔|幄|沃|卧|肟|挝|斡|倭',
		'wu'        => '五|伍|吾|悟|捂|梧|晤|唔|牾|焐|浯|鼯|痦|寤|无|怃|妩|芜|庑|吴|误|蜈|乌|邬|坞|钨|呜|鹜|芜|勿|物|芴|务|雾|婺|武|鹉|午|仵|忤|迕|屋|舞|污|圬|毋|侮|巫|诬|恶|戊|兀|杌|阢|鋈|於',
		
		'xi'        => '西|硒|栖|牺|茜|粞|舾|系|奚|溪|蹊|喜|禧|嬉|嘻|僖|熹|戏|息|熄|媳|螅|洗|细|锡|裼|希|稀|烯|唏|浠|郗|席|习|吸|隰|袭|舄|析|晰|淅|蜥|皙|菥|熙|昔|惜|腊|悉|夕|矽|汐|穸|兮|膝|玺|歙|曦|羲|隙|犀|铣|徙|屣|阋|禊|翕|醯|蟋|檄|觋|欷|葸|樨|蓰|饩|鼹|鼷',
		'xia'       => '下|虾|吓|夏|厦|峡|侠|狭|硖|辖|瞎|瑕|暇|遐|霞|瘕|呷|狎|柙|匣|罅|唬|黠',
		'xian'      => '县|先|洗|冼|铣|跣|酰|宪|筅|线|现|蚬|岘|限|显|贤|险|猃|莶|仙|籼|氙|鲜|藓|献|咸|羡|陷|馅|闲|嫌|纤|跹|弦|舷|衔|娴|鹇|痫|掀|锨|腺|暹|涎|霰|祆|燹|苋|见',
		'xiang'     => '向|响|饷|项|象|橡|像|蟓|乡|芗|相|厢|湘|缃|想|箱|葙|祥|详|庠|香|降|襄|骧|镶|翔|巷|享|飨|鲞',
		'xiao'      => '小|校|效|晓|哓|骁|笑|肖|销|消|硝|绡|蛸|削|宵|霄|逍|魈|孝|哮|啸|萧|箫|潇|筱|枭|嚣|崤|淆|枵',
		'xie'       => '些|写|泻|谢|榭|协|胁|鞋|鲑|卸|渫|解|蟹|携|邂|懈|廨|獬|斜|械|邪|歇|蝎|泄|绁|谐|偕|血|屑|挟|燮|契|楔|颉|缬|撷|躞|薤|瀣|榍|亵|勰|叶',
		'xin'       => '新|薪|心|芯|信|欣|忻|昕|辛|锌|莘|鑫|馨|歆|寻|衅|镡|囟',
		'xing'      => '省|性|姓|行|荇|型|星|醒|腥|猩|惺|形|邢|刑|硎|幸|悻|悻|杏|荥|兴|陉|擤',
		'xiong'     => '熊|雄|凶|汹|兄|匈|芎|胸',
		'xiu'       => '修|秀|休|咻|貅|鸺|庥|髹|绣|锈|袖|岫|宿|羞|馐|臭|溴|嗅|朽',
		'xu'        => '需|徐|叙|溆|许|浒|须|顼|续|序|虚|嘘|墟|畜|蓄|胥|婿|醑|糈|旭|绪|圩|吁|盱|恤|戌|煦|诩|栩|蓿|絮|勖|酗|砉|洫',
		'xuan'      => '宣|喧|煊|暄|渲|楦|碹|揎|萱|选|旋|璇|漩|轩|镟|悬|玄|眩|炫|铉|泫|痃|癣|券|绚|谖|儇',
		'xue'       => '学|雪|鳕|血|薛|穴|靴|削|谑|噱|泶|踅',
		'xun'       => '讯|汛|迅|训|驯|逊|寻|鲟|浔|荨|尊|旬|询|洵|徇|峋|殉|恂|郇|荀|巡|勋|埙|循|熏|醺|獯|曛|薰|巽|浚|荤|窨|蕈|彐',
		
		'ya'        => '亚|娅|哑|垭|桠|氩|痖|压|雅|鸭|押|牙|蚜|伢|蚜|鸦|讶|砑|迓|琊|岈|芽|轧|涯|睚|崖|衙|丫|揠|疋|埏',
		'yan'       => '严|俨|酽|砚|言|唁|盐|焰|阎|眼|烟|咽|胭|燕|演|验|艳|滟|岩|延|蜒|筵|沿|铅|炎|琰|剡|焱|研|妍|彦|谚|晏|鼹|宴|堰|郾|偃|颜|焉|鄢|嫣|雁|奄|腌|淹|掩|崦|厣|罨|阉|衍|闫|厌|恹|檐|赝|湮|殷|魇|餍|兖|芫|鼯|阽|谳|阏|菸',
		'yang'      => '阳|养|羊|样|洋|蛘|烊|徉|佯|氧|痒|漾|恙|央|秧|泱|怏|鞅|殃|鸯|杨|扬|炀|疡|仰',
		'yao'       => '要|腰|药|姚|珧|铫|耀|曜|幺|么|吆|窈|尧|侥|瑶|摇|谣|遥|鳐|崾|徭|鹞|繇|窑|陶|咬|邀|夭|妖|杳|舀|钥|约|爻|肴|轺|疟',
		'ye'        => '也|业|叶|夜|页|液|掖|腋|野|邺|冶|爷|烨|晔|哗|耶|揶|椰|邪|铘|噎|曳|谒|靥|咽',
		'yi'        => '一|以|苡|已|异|乙|亿|忆|钇|屹|仡|艺|呓|易|埸|蜴|意|臆|镱|噫|薏|癔|荑|痍|亦|益|溢|镒|嗌|缢|依|铱|医|宜|谊|义|仪|议|蚁|舣|艾|衣|裔|伊|咿|移|移|羿|弈|毅|译|驿|怿|峄|绎|弋|奕|翼|疑|嶷|沂|遗|逸|役|疫|邑|挹|悒|轶|佚|矣|怡|眙|诒|贻|饴|夷|姨|胰|咦|熠|抑|椅|猗|倚|漪|旖|欹|彝|壹|殪|颐|尾|迤|翌|翊|黟|懿|诣|揖|佾|劓|刈|肄|酏|翳|蛾|瘗|圯|蛇',
		'yin'       => '因|姻|洇|烟|铟|氤|茵|引|蚓|吲|印|茚|银|垠|龈|音|喑|窨|隐|尹|饮|阴|荫|殷|瘾|寅|夤|淫|吟|鄞|霪|胤|湮|堙|狺|圻',
		'ying'      => '映|瑛|英|应|硬|迎|影|鹰|盈|赢|嬴|瀛|颍|颖|婴|缨|樱|嘤|撄|瘿|璎|鹦|营|莹|荧|萦|莺|萤|茔|荥|蓥|滢|蝇|郢|膺|楹|媵|潆|罂',
		'yo'        => '哟|育|唷',
		'yong'      => '用|拥|佣|痈|甬|涌|俑|蛹|踊|勇|恿|雍|臃|壅|饔|永|泳|咏|庸|镛|慵|鳙|墉|邕|喁|场',
		'you'       => '有|侑|铕|宥|囿|由|油|柚|釉|铀|邮|蚰|鼬|又|尢|犹|优|忧|尤|鱿|疣|友|游|蝣|右|佑|幼|蚴|呦|黝|幽|诱|莠|悠|酉|蝤|攸|猷|牖|鼢|卣|莸|繇|莜',
		'yu'        => '与|屿|欤|于|吁|纡|宇|芋|竽|迂|盂|余|馀|狳|玉|钰|鱼|渔|域|雨|雩|育|誉|予|妤|豫|预|蓣|语|龉|圄|谷|裕|浴|峪|欲|鹆|俞|喻|蝓|愉|渝|榆|瑜|揄|谕|觎|嵛|愈|逾|窬|毓|郁|禹|俣|娱|虞|羽|禺|喁|隅|愚|遇|寓|御|狱|於|淤|瘀|昱|煜|舆|尉|蔚|熨|聿|鹬|臾|谀|腴|萸|庾|瘐|燠|驭|窳|菀|蜮|妪|伛|圉|鬻|阈|舁|饫|畲|粥',
		'yuan'      => '元|沅|垸|芫|远|园|鼋|原|源|塬|螈|愿|员|圆|院|袁|猿|辕|缘|掾|橼|垣|渊|苑|箢|爰|援|媛|瑗|怨|眢|冤|鸳|鸢|圜',
		'yue'       => '月|刖|钥|越|樾|约|跃|岳|粤|乐|栎|悦|说|阅|曰|钺|瀹|龠|哕',
		'yun'       => '云|耘|酝|纭|运|芸|员|陨|殒|郧|恽|郓|晕|愠|韫|蕴|氲|孕|允|狁|匀|韵|均|昀|筠|熨',
		
		'za'        => '杂|扎|咋|匝|砸|咂|拶',
		'zai'       => '在|再|哉|栽|载|灾|宰|仔|崽|甾',
		'zan'       => '咱|昝|赞|攒|瓒|簪|趱|拶|暂|糌|錾',
		'zang'      => '脏|臧|藏|葬|赃|奘|驵',
		'zao'       => '枣|早|造|糟|遭|灶|凿|噪|澡|躁|燥|缲|藻|皂|唣|蚤',
		'ze'        => '则|侧|泽|择|责|赜|啧|帻|箦|咋|舴|迮|笮|仄|昃',
		'zei'       => '贼',
		'zen'       => '怎|谮',
		'zeng'      => '曾|增|赠|憎|缯|罾|综|甑',
		'zha'       => '扎|轧|札|蜡|乍|炸|诈|咋|蚱|柞|砟|痄|榨|查|楂|渣|揸|喳|齄|闸|咤|栅|眨|铡|吒|喋|哳',
		'zhai'      => '寨|债|摘|翟|祭|瘵|砦|窄|宅|斋|侧|择',
		'zhan'      => '占|站|粘|沾|战|毡|展|搌|辗|湛|詹|瞻|谵|斩|崭|颤|栈|盏|蘸|绽|旃',
		'zhang'     => '长|张|账|胀|帐|涨|章|蟑|障|漳|樟|璋|幛|嶂|獐|嫜|彰|鄣|瘴|仉|掌|丈|仗|杖',
		'zhao'      => '找|赵|着|照|兆|朝|嘲|召|昭|招|沼|诏|罩|棹|肇|钊|爪|笊|啁',
		'zhe'       => '着|者|锗|赭|折|浙|哲|蜇|蛰|蔗|鹧|遮|辙|柘|辄|谪|磔|褶',
		'zhei'      => '这',
		'zhen'      => '真|镇|缜|稹|针|甄|振|赈|震|珍|诊|疹|轸|胗|畛|阵|贞|桢|侦|祯|浈|帧|圳|枕|臻|榛|溱|蓁|斟|椹|箴|鸩|朕|砧',
		'zheng'     => '正|证|政|征|怔|钲|整|症|郑|争|挣|睁|铮|峥|诤|狰|筝|丁|蒸|拯|鲭',
		'zhi'       => '至|侄|桎|轾|蛭|致|窒|膣|之|芝|只|识|职|织|帜|轵|枳|制|志|支|枝|忮|吱|肢|治|直|值|植|殖|埴|置|质|踬|纸|旨|酯|指|脂|知|蜘|智|执|止|址|趾|祉|芷|滞|郅|汁|掷|踯|炙|稚|峙|痔|雉|挚|秩|栉|痣|彘|骘|贽|鸷|帙|黹|豸|跖|絷|徵|摭|咫|祗|胝|觯|卮|栀|瘛|氏',
		'zhong'     => '中|忠|种|钟|肿|仲|舯|盅|众|重|锺|踵|终|衷|冢|忪|螽',
		'zhou'      => '州|洲|周|啁|舟|粥|骤|皱|轴|妯|宙|肘|昼|绉|诌|胄|咒|纣|酎|荮|帚|籀|碡|繇',
		'zhu'       => '主|住|驻|柱|注|拄|蛀|炷|疰|诸|猪|渚|褚|潴|槠|煮|箸|著|翥|铸|伫|贮|术|橥|朱|珠|株|蛛|侏|诛|洙|铢|邾|茱|助|竹|筑|逐|祝|属|嘱|瞩|躅|烛|竺|杼|舳|苎|麈|瘃',
		'zhua'      => '爪|抓|挝',
		'zhuai'     => '拽|转',
		'zhuan'     => '专|转|砖|传|啭|撰|馔|赚|篆|沌|颛',
		'zhuang'    => '装|庄|壮|桩|幢|撞|僮|状|妆|奘|戆',
		'zhui'      => '追|缒|坠|椎|锥|骓|隹|缀|惴',
		'zhun'      => '准|谆|屯|肫|窀',
		'zhuo'      => '着|卓|桌|倬|焯|镯|灼|酌|捉|浊|拙|茁|涿|琢|啄|诼|濯|擢|浞|禚|斫|缴',
		'zi'        => '自|子|籽|仔|耔|字|资|粢|姿|咨|恣|谘|趑|紫|訾|滋|嵫|孳|淄|鲻|锱|缁|辎|孜|梓|秭|兹|渍|吱|姊|眦|呲|龇|茈|赀|觜|髭|笫|滓',
		'zong'      => '总|宗|综|纵|棕|踪|粽|腙|鬃|偬|枞',
		'zou'       => '走|邹|驺|奏|揍|陬|诹|鲰|鄹',
		'zu'        => '足|组|租|祖|阻|俎|诅|菹|族|镞|卒',
		'zuan'      => '钻|赚|攥|纂|缵|躜',
		'zui'       => '最|蕞|罪|觜|嘴|醉|咀',
		'zun'       => '尊|撙|鳟|樽|遵',
		'zuo'       => '作|昨|柞|祚|怍|胙|阼|笮|做|坐|唑|座|左|佐|撮|嘬|琢|凿'
	);

	// ピンインをカナに変換
	// http://staff.aist.go.jp/sakamoto.yasuhiko/acronym/EJCjpinyin.htm
	// 2007年4月時点版(出典：NHKラジオ中国語講座テキスト2007年4月号入門編の末尾の表)
	static protected $kana_table = array(
		'a'         => 'アー',
		'ai'        => 'アイ',
		'an'        => 'アン',
		'ang'       => 'アーン',
		'ao'        => 'アオ',
		
		'ba'        => 'バー',
		'bai'       => 'バイ',
		'ban'       => 'バン',
		'bang'      => 'バーン',
		'bao'       => 'バオ',
		'bei'       => 'ベイ',
		'ben'       => 'ベン',
		'beng'      => 'ブオン',
		'bi'        => 'ビー',
		'bian'      => 'ビエン',
		'biao'      => 'ビヤオ',
		'bie'       => 'ビエ',
		'bin'       => 'ビン',
		'bing'      => 'ビーン',
		'bo'        => 'ボー',
		'bu'        => 'ブゥ',
		
		'ca'        => 'ツァー',
		'cai'       => 'ツァイ',
		'can'       => 'ツァン',
		'cang'      => 'ツァーン',
		'cao'       => 'ツァオ',
		'ce'        => 'ツォーァ',
		'ceng'      => 'ツェン',
		'cha'       => 'チャア',
		'chai'      => 'チャイ',
		'chan'      => 'チャン',
		'chang'     => 'チャーン',
		'chao'      => 'チャオ',
		'che'       => 'チョーァ',
		'chen'      => 'チェン',
		'cheng'     => 'チュヨン',
		'chi'       => 'チー',
		'chong'     => 'チョーン',
		'chou'      => 'チョウ',
		'chu'       => 'チュウ',
		'chuai'     => 'チュワイ',
		'chuan'     => 'チュワン',
		'chuang'    => 'チュワーン',
		'chui'      => 'チュウイ',
		'chun'      => 'チュン',
		'chuo'      => 'チュオ',
		'ci'        => 'ツー',
		'cong'      => 'ッオーン',
		'cou'       => 'ツォウ',
		'cu'        => 'ツゥ',
		'cuan'      => 'ツワン',
		'cui'       => 'ツゥイ',
		'cun'       => 'ツゥン',
		'cuo'       => 'ツゥオ',

		'da'        => 'ダー',
		'dai'       => 'ダイ',
		'dan'       => 'ダン',
		'dang'      => 'ダーン',
		'dao'       => 'ダオ',
		'de'        => 'ドーァ',
		'deng'      => 'ドゥオン',
		'di'        => 'ディー',
		'dian'      => 'ディエン',
		'diao'      => 'ディヤオ',
		'die'       => 'ディエ',
		'ding'      => 'ディーン',
		'diu'       => 'ディウ',
		'dong'      => 'ドーン',
		'dou'       => 'ドウ',
		'du'        => 'ドゥ',
		'duan'      => 'ドワン',
		'dui'       => 'ドゥイ',
		'dun'       => 'ドゥン',
		'duo'       => 'ドゥオ',
		
		'e'         => 'オーァ',
		'en'        => 'エン',
		'er'        => 'アル',
		
		'fa'        => 'ファー',
		'fan'       => 'ファン',
		'fang'      => 'ファーン',
		'fei'       => 'フェイ',
		'fen'       => 'フェン',
		'feng'      => 'フオン',
		'fo'        => 'フォー',
		'fou'       => 'フォウ',
		'fu'        => 'フゥ',
		
		'ga'        => 'ガー',
		'gai'       => 'ガイ',
		'gan'       => 'ガン',
		'gang'      => 'ガーン',
		'gao'       => 'ガオ',
		'ge'        => 'ゴーァ',
		'gei'       => 'ゲイ',
		'gen'       => 'ゲン',
		'geng'      => 'グオン',
		'gong'      => 'ゴーン',
		'gou'       => 'ゴウ',
		'gu'        => 'グゥ',
		'gua'       => 'グワ',
		'guai'      => 'グワイ',
		'guan'      => 'グワン',
		'guang'     => 'グワーン',
		'gui'       => 'グイ',
		'gun'       => 'グン',
		'guo'       => 'グオ',
		
		'ha'        => 'ハー',
		'hai'       => 'ハイ',
		'han'       => 'ハン',
		'hang'      => 'ハーン',
		'hao'       => 'ハオ',
		'he'        => 'ホーァ',
		'hei'       => 'ヘイ',
		'hen'       => 'ヘン',
		'heng'      => 'ホゥオン',
		'hong'      => 'ホーン',
		'hou'       => 'ホウ',
		'hu'        => 'ホゥ',
		'hua'       => 'ホワ',
		'huai'      => 'ホワイ',
		'huan'      => 'ホワン',
		'huang'     => 'ホワーン',
		'hui'       => 'ホゥイ',
		'hun'       => 'ホゥン',
		'huo'       => 'ホオ',
		
		'ji'        => 'ジー',
		'jia'       => 'ジア',
		'jian'      => 'ジエン',
		'jiang'     => 'ジアーン',
		'jiao'      => 'ジアオ',
		'jie'       => 'ジエ',
		'jin'       => 'ジン',
		'jing'      => 'ジーン',
		'jiong'     => 'ジオーン',
		'jiu'       => 'ジウ',
		'ju'        => 'ジュイ',
		'juan'      => 'ジュエン',
		'jue'       => 'ジュエ',
		'jun'       => 'ジュイン',
		
		'ka'        => 'カー',
		'kai'       => 'カイ',
		'kan'       => 'カン',
		'kang'      => 'カーン',
		'kao'       => 'カオ',
		'ke'        => 'コーァ',
		'ken'       => 'ケン',
		'keng'      => 'クオン',
		'kong'      => 'コーン',
		'kou'       => 'コウ',
		'ku'        => 'クゥ',
		'kua'       => 'クワ',
		'kuai'      => 'クワイ',
		'kuan'      => 'クワン',
		'kuang'     => 'クワーン',
		'kui'       => 'クイ',
		'kun'       => 'クン',
		'kuo'       => 'クオ',
		
		'la'        => 'ラー',
		'lai'       => 'ライ',
		'lan'       => 'ラン',
		'lang'      => 'ラーン',
		'lao'       => 'ラオ',
		'le'        => 'ローァ',
		'lei'       => 'レイ',
		'leng'      => 'ルオン',
		'li'        => 'リー',
		'lian'      => 'リエン',
		'liang'     => 'リヤーン',
		'liao'      => 'リヤオ',
		'lie'       => 'リエ',
		'lin'       => 'リン',
		'ling'      => 'リーン',
		'liu'       => 'リウ',
		'lo'        => 'ロ',
		'long'      => 'ローン',
		'lou'       => 'ロウ',
		'lu'        => 'ルゥ',
		'luan'      => 'ルワン',
		'lun'       => 'ルン',
		'luo'       => 'ルオ',
		'lü'        => 'リュイ',
		'lüe'       => 'リュエ',

		'ma'        => 'マー',
		'mai'       => 'マイ',
		'mao'       => 'マオ',
		'man'       => 'マン',
		'mang'      => 'マーン',
		'me'        => 'モーァ',
		'mei'       => 'メイ',
		'men'       => 'メン',
		'meng'      => 'ムオン',
		'mi'        => 'ミー',
		'mian'      => 'ミエン',
		'miao'      => 'ミヤオ',
		'mie'       => 'ミエ',
		'min'       => 'ミン',
		'ming'      => 'ミーン',
		'miu'       => 'ミウ',
		'mo'        => 'モー',
		'mou'       => 'モウ',
		'mu'        => 'ムゥ',
		
		'na'        => 'ナー',
		'nai'       => 'ナイ',
		'nan'       => 'ナン',
		'nang'      => 'ナーン',
		'nao'       => 'ナオ',
		'ne'        => 'ノーァ',
		'nei'       => 'ネイ',
		'nen'       => 'ネン',
		'neng'      => 'ヌオン',
		'ni'        => 'ニー',
		'nian'      => 'ニエン',
		'niang'     => 'ニヤーン',
		'niao'      => 'ニヤオ',
		'nie'       => 'ニエ',
		'nin'       => 'ニン',
		'ning'      => 'ニーン',
		'niu'       => 'ニウ',
		'nong'      => 'ノーン',
		'nou'       => 'ノウ',
		'nu'        => 'ヌゥ',
		'nuan'      => 'ヌワン',
		'nuo'       => 'ヌオ',
		'nü'        => 'ニュイ',
		'nüe'       => 'ニュエ',

		'ou'        => 'オウ',

		'pa'        => 'パー',
		'pai'       => 'パイ',
		'pan'       => 'パン',
		'pang'      => 'パーン',
		'pao'       => 'パオ',
		'pei'       => 'ペイ',
		'pen'       => 'ペン',
		'peng'      => 'プオン',
		'pi'        => 'ピー',
		'pian'      => 'ピエン',
		'piao'      => 'ピヤオ',
		'pie'       => 'ピエ',
		'pin'       => 'ピン',
		'ping'      => 'ピーン',
		'po'        => 'ポー',
		'pou'       => 'ポウ',
		'pu'        => 'プゥ',

		'qi'        => 'チイ',
		'qia'       => 'チア',
		'qian'      => 'チエン',
		'qiang'     => 'チアーン',
		'qiao'      => 'チヤオ',
		'qie'       => 'チエ',
		'qin'       => 'チン',
		'qing'      => 'チーン',
		'qiong'     => 'チオーン',
		'qiu'       => 'チウ',
		'qu'        => 'チュイ',
		'quan'      => 'チュエン',
		'que'       => 'チュエ',
		'qun'       => 'チュイン',

		'ran'       => 'ゥラン',
		'rang'      => 'ゥラーン',
		'rao'       => 'ゥラオ',
		're'        => 'ゥローァ',
		'ren'       => 'ゥレン',
		'reng'      => 'ゥルオン',
		'ri'        => 'ゥリー',
		'rong'      => 'ゥローン',
		'rou'       => 'ゥロウ',
		'ru'        => 'ゥルゥ',
		'ruan'      => 'ゥルワン',
		'rui'       => 'ゥルイ',
		'run'       => 'ゥルン',
		'ruo'       => 'ゥルオ',
		
		'sa'        => 'サー',
		'sai'       => 'サイ',
		'san'       => 'サン',
		'sang'      => 'サーン',
		'sao'       => 'サオ',
		'se'        => 'ソーァ',
		'sen'       => 'セン',
		'seng'      => 'スオン',
		'sha'       => 'シャア',
		'shai'      => 'シャイ',
		'shan'      => 'シャン',
		'shang'     => 'シャーン',
		'shao'      => 'シャオ',
		'she'       => 'ショーァ',
		'shei'      => 'シェイ',
		'shen'      => 'シェン',
		'sheng'     => 'シュヨン',
		'shi'       => 'シー',
		'shou'      => 'ショウ',
		'shu'       => 'シュウ',
		'shua'      => 'シュワ',
		'shuai'     => 'シュワイ',
		'shuan'     => 'シュワン',
		'shuang'    => 'シュワーン',
		'shui'      => 'シュウイ',
		'shun'      => 'シュン',
		'shuo'      => 'シュオ',
		'si'        => 'スー',
		'song'      => 'ソーン',
		'sou'       => 'ソウ',
		'su'        => 'スゥ',
		'suan'      => 'スワン',
		'sui'       => 'スゥイ',
		'sun'       => 'スゥン',
		'suo'       => 'スゥオ',
		
		'ta'        => 'ター',
		'tai'       => 'タイ',
		'tan'       => 'タン',
		'tang'      => 'ターン',
		'tao'       => 'タオ',
		'te'        => 'トーァ',
		'teng'      => 'トゥオン',
		'ti'        => 'ティー',
		'tian'      => 'ティエン',
		'tiao'      => 'ティヤオ',
		'tie'       => 'ティエ',
		'ting'      => 'ティーン',
		'tong'      => 'トーン',
		'tou'       => 'トウ',
		'tu'        => 'トゥ',
		'tuan'      => 'トワン',
		'tui'       => 'トゥイ',
		'tun'       => 'トゥン',
		'tuo'       => 'トゥオ',
		
		'wa'        => 'ワー',
		'wai'       => 'ワイ',
		'wan'       => 'ワン',
		'wang'      => 'ワーン',
		'wei'       => 'ウエイ',
		'wen'       => 'ウエン',
		'weng'      => 'ウォーン',
		'wo'        => 'ウオ',
		'wu'        => 'ウー',
		
		'xi'        => 'シイ',
		'xia'       => 'シア',
		'xian'      => 'シエン',
		'xiang'     => 'シアーン',
		'xiao'      => 'シヤオ',
		'xie'       => 'シエ',
		'xin'       => 'シン',
		'xing'      => 'シーン',
		'xiong'     => 'シオーン',
		'xiu'       => 'シウ',
		'xu'        => 'シュイ',
		'xuan'      => 'シュエン',
		'xue'       => 'シュエ',
		'xun'       => 'シュイン',
		
		'ya'        => 'ヤー',
		'yan'       => 'イエン',
		'yang'      => 'ヤーン',
		'yao'       => 'ヤオ',
		'ye'        => 'イエ',
		'yi'        => 'イー',
		'yin'       => 'イン',
		'ying'      => 'イーン',
		'yo'        => 'ヨ',
		'yong'      => 'ヨーン',
		'you'       => 'ヨウ',
		'yu'        => 'ユイ',
		'yuan'      => 'ユエン',
		'yue'       => 'ユエ',
		'yun'       => 'ユイン',
		
		'za'        => 'ザー',
		'zai'       => 'ザイ',
		'zan'       => 'ザン',
		'zang'      => 'ザーン',
		'zao'       => 'ザオ',
		'ze'        => 'ゾーァ',
		'zei'       => 'ゼイ',
		'zen'       => 'ゼン',
		'zeng'      => 'ズオン',
		'zha'       => 'ジャア',
		'zhai'      => 'ジャイ',
		'zhan'      => 'ジャン',
		'zhang'     => 'ジャーン',
		'zhao'      => 'ジャオ',
		'zhe'       => 'ジョーァ',
		'zhei'      => 'ジェイ',
		'zhen'      => 'ジェン',
		'zheng'     => 'ジュヨン',
		'zhi'       => 'ジー',
		'zhong'     => 'ジョーン',
		'zhou'      => 'ジョウ',
		'zhu'       => 'ジュウ',
		'zhua'      => 'ジュワ',
		'zhuai'     => 'ジュワイ',
		'zhuan'     => 'ジュワン',
		'zhuang'    => 'ジュワーン',
		'zhui'      => 'ジュウイ',
		'zhun'      => 'ジュン',
		'zhuo'      => 'ジュオ',
		'zi'        => 'ズー',
		'zong'      => 'ゾーン',
		'zou'       => 'ゾウ',
		'zu'        => 'ズゥ',
		'zuan'      => 'ズワン',
		'zui'       => 'ズゥイ',
		'zun'       => 'ズゥン',
		'zuo'       => 'ズゥオ'
	);
	/**
	 * ピンイン変換
	 * @param string $str 入力文字列
	 * @return string
	 */
	public static function toPinYin($char){
		// 漢字をピンインにする
		foreach (self::$pinyin_table as $pinyin=>$pinyin_pattern){
			if (preg_match('/'.$pinyin_pattern.'+/', $char)){
				return $pinyin;
			}
		}
		return $char;
	}
	/**
	 * かな変換
	 * @param string $char 入力文字列
	 * @return string
	 */
	public static function toKana($char){
		// 漢字をピンインにする
		foreach (self::$pinyin_table as $pinyin=>$pinyin_pattern){
			if (preg_match('/'.$pinyin_pattern.'+/', $char)){
				return self::$kana_table[$pinyin];
			}
		}
		return $char;
	}
}

/* End of file PinYin.php */
/* Location: /vendor/PukiWiki/Lib/Text/PinYin.php */