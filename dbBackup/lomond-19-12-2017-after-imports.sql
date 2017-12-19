# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.18)
# Database: lomond
# Generation Time: 2017-12-19 21:47:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;

INSERT INTO `activity` (`id`, `name`)
VALUES
	(5,'Canoeing'),
	(6,'Kayaking'),
	(7,'Climbing'),
	(8,'Hill Walking');

/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table enquiry
# ------------------------------------------------------------

DROP TABLE IF EXISTS `enquiry`;

CREATE TABLE `enquiry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `telephone` varchar(20) DEFAULT NULL,
  `activity` int(11) unsigned NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `activity` (`activity`),
  CONSTRAINT `enquiry_ibfk_1` FOREIGN KEY (`activity`) REFERENCES `activity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `enquiry` WRITE;
/*!40000 ALTER TABLE `enquiry` DISABLE KEYS */;

INSERT INTO `enquiry` (`id`, `name`, `email`, `telephone`, `activity`, `message`, `created_at`)
VALUES
	(31,'Chris Connor','chris@connor.com','0141 123 1234',8,'asdasdasd','2017-12-16 20:00:29'),
	(32,'Peter Parker','peter@parker.com','',5,'asdasdasd','2017-12-16 20:00:43'),
	(33,'Francine O\'Rourke','frankieo@gmail.com','01236 731260',7,'Hi there,\r\n\r\nI hope this email finds you well.\r\n\r\nI just wanted to check if you had any availability for the next two weeks.\r\n\r\nIf so, please do let me know.\r\n\r\nKind Regards,\r\nFrankie O\'Rourke','2017-12-17 20:28:55'),
	(34,'Tommy Berry','tommyberry@hotmail.com','0141 1234567',8,'Hi There,\r\n\r\nCan you tell me about hill walking.\r\n\r\nThanks,\r\nChris','2017-12-17 23:52:56'),
	(35,'Chris Connor','chris@chrisconnor.co.uk','0141 123 1234',6,'asdsadasd','2017-12-18 13:57:40'),
	(36,'Jack Brierson','jack@nzworld.com','+44770 9328683',5,'Hi Jack,\r\n\r\nThank you for sending this through.\r\n\r\nMany Thanks,\r\nJack ','2017-12-18 16:58:42');

/*!40000 ALTER TABLE `enquiry` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table newsletter
# ------------------------------------------------------------

DROP TABLE IF EXISTS `newsletter`;

CREATE TABLE `newsletter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(65) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;

INSERT INTO `newsletter` (`id`, `email`, `datetime`)
VALUES
	(35,'michelleconnor227@gmail.com','2017-12-17 13:36:10'),
	(36,'asdasd@asdasda.com','2017-12-17 13:38:29'),
	(37,'anewone.cjconnor24@gmail.com','2017-12-17 13:38:41'),
	(38,'sadasdas@asdasd.com','2017-12-17 13:38:57'),
	(39,'asdasd@asdoiashdoi.com','2017-12-17 14:16:25'),
	(40,'chris@chrisconnor.co.uk','2017-12-17 19:40:31'),
	(41,'chris@connor.com','2017-12-17 20:00:29'),
	(42,'frankieo@gmail.com','2017-12-17 20:28:55'),
	(43,'tommyberry@hotmail.com','2017-12-17 23:52:25'),
	(44,'ewfwerQ@asdasd.com','2017-12-18 12:41:33'),
	(45,'jack@nzworld.com','2017-12-18 16:58:42'),
	(46,'sadasd@asadasd.cpm','2017-12-19 09:49:02'),
	(47,'sadad@asdasd.com','2017-12-19 16:52:03');

/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table response
# ------------------------------------------------------------

DROP TABLE IF EXISTS `response`;

CREATE TABLE `response` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `enquiry` int(11) unsigned NOT NULL,
  `user` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `enquiry` (`enquiry`),
  CONSTRAINT `response_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  CONSTRAINT `response_ibfk_2` FOREIGN KEY (`enquiry`) REFERENCES `enquiry` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `response` WRITE;
/*!40000 ALTER TABLE `response` DISABLE KEYS */;

INSERT INTO `response` (`id`, `message`, `enquiry`, `user`, `created_at`)
VALUES
	(13,'How would that work, actually?',32,1,'2017-12-17 23:23:48'),
	(14,'Hi Chris,\r\n\r\nThank you for that enquiry - mcuh appreciated.\r\n\r\nKind Regards,\r\nChris COnnor',31,1,'2017-12-17 23:34:49'),
	(15,'Hi Francie,\r\n\r\nYes, we do have climbing availability - if you would like to check that, you can do so here.\r\n\r\nKind Regards,\r\nChris Connor',33,1,'2017-12-17 23:35:41'),
	(16,'Thanks for your message tommy.\r\n\r\nBlah blah hill walking.',34,1,'2017-12-17 23:53:24'),
	(17,'No problem jack, this has been updated for you.\r\n\r\nKind Regards,\r\nChris COnnor',36,1,'2017-12-19 09:26:55');

/*!40000 ALTER TABLE `response` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table route
# ------------------------------------------------------------

DROP TABLE IF EXISTS `route`;

CREATE TABLE `route` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(65) DEFAULT '',
  `description` text,
  `difficulty` int(2) DEFAULT NULL,
  `distance` float DEFAULT NULL,
  `coordinates` text NOT NULL,
  `activity` int(11) unsigned NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `activity` (`activity`),
  CONSTRAINT `route_ibfk_1` FOREIGN KEY (`activity`) REFERENCES `activity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;

INSERT INTO `route` (`id`, `name`, `description`, `difficulty`, `distance`, `coordinates`, `activity`, `enabled`, `created_at`)
VALUES
	(15,'Town Walk','Very easy walk.',1,1.98226,'[[-4.555635452270508,56.09698663151968],[-4.554476737976074,56.09715419503198],[-4.552974700927734,56.09753719460766],[-4.552159309387207,56.09787231611134],[-4.551386833190918,56.09765688119381],[-4.55082893371582,56.09722600774261],[-4.550571441650391,56.09698663151968],[-4.549884796142577,56.09681906727818],[-4.549198150634766,56.096364246375586],[-4.548296928405762,56.0960530500311],[-4.547996520996094,56.09564609717043],[-4.548039436340332,56.095358833738224],[-4.548425674438476,56.0952630787846],[-4.548125267028809,56.09499975143441],[-4.548468589782715,56.09476036137166],[-4.5487260818481445,56.09432945550847],[-4.548554420471191,56.09397036360589],[-4.547953605651855,56.09349156919375],[-4.5476531982421875,56.093228229729725],[-4.548039436340332,56.092533962511],[-4.547910690307617,56.09231849772584],[-4.548254013061523,56.09234243831707],[-4.548897743225097,56.09191150539825],[-4.549927711486816,56.09150450876963],[-4.550356864929198,56.09119327315151],[-4.551429748535156,56.09171997810878],[-4.551644325256348,56.0924382005331],[-4.551944732666016,56.09313246947813],[-4.552459716796875,56.09380278623878],[-4.552717208862305,56.094353394849584],[-4.553704261779785,56.09488005658905],[-4.554905891418457,56.095502465722184],[-4.555506706237793,56.09624455577148],[-4.555764198303223,56.09686694285016]]',8,1,'2017-12-19 08:50:59'),
	(16,'Conic Hill Walking Route','This is really nice.\r\nLovely in the winder.\r\nKeep an eye out though.',1,3.32066,'[[-4.533727169036865,56.08646457650852],[-4.53411340713501,56.08662021373805],[-4.535036087036133,56.08683571040236],[-4.534907341003418,56.08720684072044],[-4.535164833068848,56.087518108552665],[-4.535336494445801,56.087817402173144],[-4.535079002380371,56.08821246619136],[-4.534907341003418,56.08872724049894],[-4.534628391265869,56.08937369151262],[-4.534242153167725,56.08962508619898],[-4.5336198806762695,56.089948305527535],[-4.533019065856934,56.09027152214372],[-4.532761573791504,56.09063064853606],[-4.532353878021239,56.090905976502434],[-4.532353878021239,56.09128903822498],[-4.53282594680786,56.09166012563547],[-4.533061981201172,56.09195938707178],[-4.53310489654541,56.0921628835202],[-4.533834457397461,56.09239031945484],[-4.53411340713501,56.09247411130271],[-4.534478187561035,56.092964888464934],[-4.534242153167725,56.09332398974318],[-4.53385591506958,56.09386263538218],[-4.533812999725341,56.09412597050812],[-4.533426761627197,56.09437733417582],[-4.5320963859558105,56.094796269975944],[-4.531044960021973,56.095107476477125],[-4.530057907104492,56.09556231222407],[-4.529585838317871,56.09606501916776],[-4.528834819793701,56.096388184451754],[-4.528341293334961,56.096424091538125],[-4.527525901794434,56.09675922272952],[-4.526453018188477,56.09701056920894],[-4.525809288024902,56.09714222623384],[-4.525487422943115,56.097046475714926],[-4.5261311531066895,56.0968070983759],[-4.526581764221191,56.096591657498415],[-4.52686071395874,56.096304401120044],[-4.527418613433838,56.096184710329915],[-4.528212547302246,56.095861543338295],[-4.528942108154296,56.09564609717043],[-4.529178142547607,56.095502465722184],[-4.5293498039245605,56.095370803090674],[-4.529457092285156,56.09531095629117],[-4.529886245727538,56.095478527095416],[-4.53035831451416,56.09545458845372],[-4.53160285949707,56.094927934571835],[-4.532890319824219,56.09458081784798],[-4.533641338348389,56.09426960709057],[-4.533812999725341,56.09403021248887],[-4.534156322479248,56.093539448902874],[-4.5343708992004395,56.09313246947813],[-4.534327983856201,56.09268957521725],[-4.534006118774414,56.092426230269105],[-4.533405303955078,56.09227061649876],[-4.532976150512695,56.09181574187257],[-4.532568454742432,56.09145662653052],[-4.532375335693359,56.0911334198597],[-4.532525539398193,56.090750356589375],[-4.532890319824219,56.09045108575847],[-4.533319473266601,56.09012787064918],[-4.533898830413818,56.08978071065873],[-4.5343708992004395,56.08949340347267],[-4.534757137298584,56.089002582071956],[-4.534950256347656,56.08843992545468],[-4.535207748413086,56.08802092050673],[-4.5352935791015625,56.08767374152552],[-4.535036087036133,56.0873983904533],[-4.5349931716918945,56.087027261980786],[-4.534757137298584,56.08677585033877],[-4.5339202880859375,56.086560353339586],[-4.533555507659912,56.086452604387894]]',8,1,'2017-12-19 08:50:59'),
	(17,'Lomond Shores Walk Nice','Chris Connor is testing this now.',3,1.06759,'[[-4.59360638742247,56.0047591346466],[-4.59371199289154,56.0055209184166],[-4.59438400844601,56.0057818174044],[-4.59390071270896,56.0067087963182],[-4.5932511829547,56.0067835840391],[-4.59379177599837,56.0067110887795],[-4.59387897831443,56.0071982174719],[-4.59564165067117,56.0066415867205],[-4.59506422000802,56.0061647812606],[-4.59430372027853,56.0062113507375],[-4.59459778379901,56.0057161970487],[-4.59563798952412,56.0049608497377],[-4.59541193846582,56.0048433689212],[-4.5945228539321,56.0054121718593],[-4.59443642923644,56.0057501537626],[-4.59382501772672,56.0055796604373],[-4.59359615996367,56.0046065486488]]',8,1,'2017-12-19 08:50:59'),
	(18,'Doune Hill and Beinn Eich','dfssdfsdf',2,18.2452,'[[-4.63966936175958,56.10277890024],[-4.63999630840155,56.1023629389691],[-4.6404444136592,56.1021897659174],[-4.64064608720813,56.1017764827001],[-4.64135669224836,56.1017729619916],[-4.64166904217072,56.1017545922108],[-4.64176853923822,56.1019861590067],[-4.64265895853453,56.1021657391118],[-4.6428588479982,56.1023367314106],[-4.64418849731546,56.1025185795001],[-4.6456715048408,56.1028022896679],[-4.64698907066607,56.1034167058972],[-4.64853877335434,56.1037573760557],[-4.64969746549455,56.103884409755],[-4.65027640259055,56.1040939919351],[-4.65084090365237,56.1040935542191],[-4.6533968268083,56.105078586199],[-4.6540753730715,56.1052159004204],[-4.65989111404319,56.107077136563],[-4.66020194377792,56.1073391901119],[-4.66096165419502,56.1074396632476],[-4.66133110450936,56.1076420258867],[-4.66220328011953,56.1078569153996],[-4.66453651114763,56.1089400043869],[-4.66680770702491,56.1091246537202],[-4.66840199226725,56.1094991703634],[-4.67024592839122,56.1095527737701],[-4.67178813704684,56.1100802776936],[-4.6726748318725,56.110201300825],[-4.6750219117651,56.110874924069],[-4.67763345603376,56.1105378625936],[-4.67878351903701,56.1105362793611],[-4.67921654510019,56.1107488950352],[-4.68040615897741,56.1110151920321],[-4.68113131067148,56.1109176487004],[-4.68446868467733,56.1113943062981],[-4.68571338579243,56.1121501231986],[-4.68619990245331,56.1119292074561],[-4.68676125886483,56.1118819352791],[-4.68766566543494,56.1119557262845],[-4.68824301817642,56.1118379892154],[-4.68955359607945,56.1108395870583],[-4.69318601720147,56.110748701241],[-4.69351358326244,56.1106480738184],[-4.69304247929676,56.1101909533335],[-4.69300610861418,56.1099697319911],[-4.69323334465186,56.1099297191005],[-4.69448648223906,56.1102061801392],[-4.69566067430115,56.1102506527164],[-4.69638448133362,56.1104334885505],[-4.6968397674041,56.1103651171059],[-4.69904781269482,56.1099429346286],[-4.70368521229398,56.1101686248186],[-4.70394519347168,56.109999339467],[-4.70604302307315,56.1100935867136],[-4.70767127688461,56.1103500056583],[-4.70816912070085,56.110292343626],[-4.70839268069126,56.1104977693103],[-4.70978636045152,56.1106891972024],[-4.7120444727494,56.1115744082625],[-4.71318846008738,56.1117829692603],[-4.71549949126544,56.1125267346312],[-4.71829345007642,56.1124068129581],[-4.71963672078446,56.1121785779174],[-4.72006175100996,56.1122743783818],[-4.72321120430414,56.1124503232372],[-4.72523615313754,56.112989888115],[-4.726710565738,56.1137285446013],[-4.72827810955588,56.114009406217],[-4.72909249812638,56.1139914036585],[-4.7298231406603,56.1142673758039],[-4.73246315574568,56.1146296289029],[-4.73360714942575,56.1151301311032],[-4.73625603270393,56.1162049014388],[-4.73738669909869,56.1168108313789],[-4.73964330355952,56.117660526557],[-4.74093921069546,56.1188236451422],[-4.74279149085755,56.1201613531369],[-4.74369762515708,56.1208423270065],[-4.74427731682613,56.1210514599874],[-4.7445928810457,56.1216637583824],[-4.74871236525992,56.1248673242491],[-4.74971482525424,56.1254292596992],[-4.75042065937612,56.126231499541],[-4.75009388720136,56.1266360750059],[-4.75195020001112,56.1280203035589],[-4.75372312163352,56.1291142358623],[-4.75600832900109,56.1309328767637],[-4.7564185970447,56.1314028111111],[-4.75678373346984,56.132411270838],[-4.75648201154914,56.1337501191095],[-4.75472865512965,56.1349811386911],[-4.75426481541373,56.1352251897832],[-4.75303456703874,56.1358719402868],[-4.75251223722004,56.1358835851268],[-4.75232916036739,56.1362499064625],[-4.75162879037232,56.1364057379686],[-4.75045041861033,56.1363151402077],[-4.74925436013785,56.1368559237071],[-4.74862837925954,56.1368815448501],[-4.74825978610909,56.1369949156186],[-4.74788710287144,56.1367578216465],[-4.74734969291258,56.1368515761283],[-4.7466375529131,56.1371361774361],[-4.74449897957085,56.1367864341868],[-4.74238263980815,56.135279332115],[-4.74105666530994,56.1345842966167],[-4.74078103798765,56.1342398611202],[-4.7388452511322,56.1332077835738],[-4.73850697825739,56.1328647328887],[-4.73712444634019,56.1319605790019],[-4.73655490191978,56.1313071516964],[-4.73502357772959,56.1306633456633],[-4.73400811945138,56.1296224903511],[-4.73133850379133,56.1282676792274],[-4.73018483317618,56.1279309578586],[-4.72789274935909,56.1259951560107],[-4.72660558860313,56.125544500801],[-4.72515433366717,56.1245482555886],[-4.72460078427771,56.124116439879],[-4.72298254104703,56.1231238554679],[-4.72145287206396,56.1221994086578],[-4.71941101354215,56.121426448136],[-4.71652622151955,56.1199709024549],[-4.71387466356926,56.118556904706],[-4.71222795286403,56.1180438976294],[-4.71076149150531,56.1177138718282],[-4.70990926305385,56.1171950709923],[-4.70860828206344,56.1168380173142],[-4.70779868857908,56.1163299519574],[-4.70467395185706,56.1156155579647],[-4.70337758277976,56.115024648774],[-4.70016503904001,56.113949830279],[-4.69874304891257,56.1136537467959],[-4.69627629464564,56.1127728522452],[-4.69396185522136,56.1122741902838],[-4.69060778579625,56.1121603855872],[-4.68820532501615,56.1118972349604],[-4.68619990245331,56.1119292074561],[-4.68571338579243,56.1121501231986],[-4.68446868467733,56.1113943062981],[-4.68113131067148,56.1109176487004],[-4.68040615897741,56.1110151920321],[-4.67921654510019,56.1107488950352],[-4.67878351903701,56.1105362793611],[-4.67763345603376,56.1105378625936],[-4.6750219117651,56.110874924069],[-4.6726748318725,56.110201300825],[-4.67178813704684,56.1100802776936],[-4.67024592839122,56.1095527737701],[-4.66840199226725,56.1094991703634],[-4.66680770702491,56.1091246537202],[-4.66453651114763,56.1089400043869],[-4.66220328011953,56.1078569153996],[-4.66133110450936,56.1076420258867],[-4.66096165419502,56.1074396632476],[-4.66020194377792,56.1073391901119],[-4.65989111404319,56.107077136563],[-4.6540753730715,56.1052159004204],[-4.6533968268083,56.105078586199],[-4.65084090365237,56.1040935542191],[-4.65027640259055,56.1040939919351],[-4.64969746549455,56.103884409755],[-4.64853877335434,56.1037573760557],[-4.64698907066607,56.1034167058972],[-4.6456715048408,56.1028022896679],[-4.64418849731546,56.1025185795001],[-4.6428588479982,56.1023367314106],[-4.64265895853453,56.1021657391118],[-4.64176853923822,56.1019861590067],[-4.64166904217072,56.1017545922108],[-4.64135669224836,56.1017729619916],[-4.64064608720813,56.1017764827001],[-4.6404444136592,56.1021897659174],[-4.63999630840155,56.1023629389691],[-4.63966936175958,56.10277890024]]',8,1,'2017-12-19 08:50:59'),
	(19,'Ben Lomond','This is a fantastic route.',3,11.5433,'[[-4.6430528207703,56.1524719516541],[-4.64085447733601,56.1518826054385],[-4.63992383518109,56.1512508514111],[-4.63899835818042,56.1513748929153],[-4.63626647052262,56.1523976727884],[-4.63508789515789,56.1529180750835],[-4.63275056815158,56.1535674337537],[-4.63147507945812,56.1540377344032],[-4.63101051395049,56.1540736968229],[-4.63000590215724,56.1544078822942],[-4.62859044457532,56.1548811325747],[-4.62799799173818,56.155779978051],[-4.62285273134351,56.1570362363843],[-4.62287580001259,56.1573746019839],[-4.62011768439176,56.1587103599021],[-4.61892515244236,56.1604038580052],[-4.61801709826143,56.1607880268413],[-4.61640222110381,56.1631420916388],[-4.61638567406343,56.1635855595243],[-4.61533517821394,56.1646243670234],[-4.61538119705808,56.1653011014262],[-4.61467020683297,56.165837465772],[-4.61545553937943,56.1663942875594],[-4.61524403816581,56.1680930361478],[-4.61678649740013,56.1687902145841],[-4.61809162064278,56.1701179814058],[-4.61812529199194,56.1706125165643],[-4.61861134074751,56.1708889385276],[-4.62061184065267,56.1735052261898],[-4.62050379729719,56.1739767009253],[-4.62100055249806,56.1744092813641],[-4.62097663590916,56.1774855442555],[-4.62060279884324,56.1781711822658],[-4.62006943895939,56.178573478856],[-4.620393783942,56.1792182435552],[-4.622422982517,56.1801917566317],[-4.62303852838685,56.1803090198365],[-4.62364471973802,56.1809738589727],[-4.62369802000287,56.1817546990892],[-4.62313573911856,56.1824182798175],[-4.62408989787939,56.1861254190998],[-4.62471443271824,56.1863728127516],[-4.62449528337851,56.1865859930139],[-4.6235760136777,56.1868140387981],[-4.6232617290981,56.1870031707829],[-4.62413919976709,56.1875319206919],[-4.62566603091676,56.1877268900675],[-4.62812833616396,56.188071826171],[-4.6294320856424,56.1883038510284],[-4.62954570955117,56.1883625530282],[-4.63072729095595,56.1888110828942],[-4.63216561404065,56.1894069329046],[-4.63214974842484,56.1895753500953],[-4.63310290494052,56.1902884819004],[-4.63351858173127,56.1903560241863],[-4.63358167450906,56.1904769191635],[-4.63450470410674,56.1903502858661],[-4.63498871291757,56.1906150057941],[-4.6353632740811,56.1908820578967],[-4.63610941804802,56.1909731038815],[-4.63640818067989,56.1913334494505],[-4.63665236146457,56.1912976801585],[-4.63707433836775,56.1914567559702],[-4.63725632595956,56.1917126316875],[-4.63827613198271,56.1917978245914],[-4.63851076228366,56.1920220148147],[-4.63836648360804,56.1923154142597],[-4.63864327251628,56.1923553447308],[-4.64005794599645,56.1918056131664],[-4.64067808126387,56.1908602857764],[-4.64173161748218,56.1906391297251],[-4.64186642279922,56.1902084086348],[-4.64298320734281,56.1893135701965],[-4.64373885351751,56.1891446069445],[-4.6446481049984,56.1892168317047],[-4.64496909941185,56.1891030018601],[-4.64648464200795,56.1880315149011],[-4.64722563015678,56.1864570829607],[-4.64723200252243,56.1857540659725],[-4.647510885147,56.1854272109983],[-4.64701533375085,56.1845974265425],[-4.64705638971846,56.1843979069022],[-4.64637990374489,56.1833275156961],[-4.64609371841748,56.1831502843104],[-4.64605375520128,56.1829677799539],[-4.64588330665764,56.1828797497459],[-4.64606535624305,56.1827383313605],[-4.64547089365705,56.1824607396292],[-4.64486699018096,56.1820458271422],[-4.64493337028462,56.181417925951],[-4.64495973507553,56.1810048013502],[-4.64510917328025,56.1807876822873],[-4.64471253891045,56.1805975322583],[-4.64469679178901,56.1803686691628],[-4.64405409766843,56.1793892230396],[-4.64400680221622,56.1790999149324],[-4.64410999278443,56.1786087464447],[-4.64427838497822,56.1782689825641],[-4.64411642526767,56.1779057282799],[-4.6441385997406,56.1774315733645],[-4.64381462235428,56.1771023458347],[-4.64356229265807,56.1762215041466],[-4.64352969382105,56.1761458015587],[-4.64288694053987,56.1759609118332],[-4.642920667745,56.1756545901825],[-4.6426714316168,56.1752168010013],[-4.64250853757283,56.1744410044922],[-4.64171866986322,56.1737091751178],[-4.64132317422257,56.173534270747],[-4.64131393728998,56.1726023877183],[-4.6410847540541,56.172057206839],[-4.64062441834421,56.1705390457426],[-4.6396855901306,56.1688324676428],[-4.63929353742947,56.1679087633972],[-4.63890070791217,56.1661752341006],[-4.63884836212518,56.1654123517074],[-4.63845950694457,56.1645344167859],[-4.63876277583633,56.1633666580986],[-4.64023863800194,56.1621280016891],[-4.64049635704962,56.1618932927398],[-4.64114420401903,56.1617572028185],[-4.64164495331313,56.1610741740021],[-4.64179872254638,56.1601235233912],[-4.64203755609666,56.1596141741095],[-4.64155504429248,56.1589674518484],[-4.64134699959639,56.1583301391437],[-4.64139654435505,56.1578553985214],[-4.64226751163094,56.1565838071448],[-4.64257042775742,56.1562106058522],[-4.64231646397092,56.1541073922526],[-4.64235970602777,56.153541105305],[-4.64293596427875,56.1531620547129],[-4.64310749298661,56.1524707817098]]',8,1,'2017-12-19 08:50:59'),
	(21,'Inchcailloch Paddle','This is a great paddle for intermediate kayakers.\r\nTaking in the views around Inchailloch, this will take you a wee while.',2,3.6195,'[[-4.548125267028809,56.08357918782822],[-4.548768997192383,56.082908693124615],[-4.5490264892578125,56.08197477034113],[-4.5490264892578125,56.081088720106074],[-4.5493268966674805,56.080226597616225],[-4.550786018371582,56.079532096025964],[-4.551301002502441,56.078933377711124],[-4.552888870239258,56.07783171170432],[-4.554605484008789,56.07687371566078],[-4.555635452270508,56.07615520299828],[-4.557223320007324,56.074598379603],[-4.558682441711426,56.07328101837533],[-4.56058144569397,56.07271813212007],[-4.562024474143982,56.072637291397626],[-4.563016891479492,56.07276603765333],[-4.56356406211853,56.07327503026694],[-4.563789367675781,56.07391575258825],[-4.56456184387207,56.074789992030276],[-4.5644330978393555,56.076083350995205],[-4.563746452331543,56.077688013816115],[-4.563231468200684,56.07919681491582],[-4.562587738037109,56.080394234055596],[-4.561729431152344,56.08192687625478],[-4.559841156005859,56.083052371543474],[-4.55683708190918,56.08350734966812],[-4.554004669189453,56.08379470150473],[-4.550056457519531,56.08348340358499],[-4.548811912536621,56.08348340358499],[-4.548254013061523,56.083698917797335]]',5,1,'2017-12-19 21:21:15'),
	(22,'Innis Fada','This is quite a difficult paddle all the way around Innis Fadda and Inchailloch.\r\nWould recommend this to experience Kayakers.',3,5.66941,'[[-4.548146724700928,56.08357918782822],[-4.549305438995361,56.0833636729461],[-4.5522236824035645,56.08325591505293],[-4.554111957550049,56.08362707986051],[-4.55782413482666,56.08356721481083],[-4.566621780395508,56.083531295736364],[-4.570398330688477,56.082669227902485],[-4.57305908203125,56.080609765548836],[-4.577007293701172,56.07926866111359],[-4.581470489501953,56.078933377711124],[-4.582672119140625,56.079891322549365],[-4.582929611206055,56.08223818675173],[-4.582157135009766,56.0842017796043],[-4.580097198486327,56.08506381314523],[-4.575033187866211,56.08573427034111],[-4.570398330688477,56.087697685004],[-4.567995071411133,56.08870329766044],[-4.564905166625977,56.089086381290464],[-4.560871124267578,56.08903849604507],[-4.552888870239258,56.08903849604507],[-4.549198150634766,56.08870329766044],[-4.5490264892578125,56.087410362279996],[-4.549198150634766,56.086069494563255],[-4.549198150634766,56.08463279878595],[-4.5490264892578125,56.08401021397561],[-4.548414945602417,56.08365701235048],[-4.548211097717285,56.083621093359724]]',5,1,'2017-12-19 21:21:15'),
	(23,'Clairnish','This is an easy wee paddle and shouldn\'t take long.\r\nSome lovely views to take in and should be fine for beginners.',1,2.58747,'[[-4.548125267028809,56.08351932270411],[-4.5487260818481445,56.08238186767117],[-4.548768997192383,56.080753452541174],[-4.5493268966674805,56.07993921916611],[-4.551644325256348,56.07855019310729],[-4.552888870239258,56.07634680768489],[-4.553790092468261,56.075197165274915],[-4.554433822631836,56.07431095917577],[-4.553747177124023,56.073376827983026],[-4.552116394042969,56.073233113482196],[-4.550528526306152,56.07387982451569],[-4.549369812011719,56.07483789498821],[-4.5487260818481445,56.075891744998636],[-4.549541473388672,56.07735271665964],[-4.54984188079834,56.078047257531864],[-4.549112319946289,56.07926866111359],[-4.54833984375,56.080226597616225],[-4.548296928405762,56.08099292967094],[-4.547953605651855,56.08250160136136],[-4.548039436340332,56.083267888167036],[-4.54807698726654,56.083496873258596]]',5,1,'2017-12-19 21:21:15'),
	(27,'Finlas Water','Downhill Finlas water route.\r\nSuitable for intermediate canoers.',2,5.15765,'[[-4.683952331542969,56.068106945852655],[-4.683523178100586,56.06729244524084],[-4.68266487121582,56.066382100661365],[-4.681291580200195,56.06551964912398],[-4.6791887283325195,56.06444155756882],[-4.6778154373168945,56.063866563078676],[-4.677214622497559,56.06360302107137],[-4.676527976989746,56.06300405526404],[-4.675540924072266,56.062021731195834],[-4.67442512512207,56.061973812308416],[-4.673395156860352,56.06111126215052],[-4.671807289123535,56.060679979835605],[-4.670391082763672,56.05996116525727],[-4.669747352600097,56.060080968617555],[-4.669361114501953,56.05988928306241],[-4.666485786437988,56.05936214287237],[-4.665927886962891,56.059457987079305],[-4.664211273193359,56.059122531312795],[-4.663739204406738,56.05869122675346],[-4.662966728210449,56.05818803200364],[-4.662280082702637,56.05883499547593],[-4.661121368408203,56.058427649370095],[-4.6602630615234375,56.058763111181676],[-4.659919738769531,56.05825991736992],[-4.6572160720825195,56.05785256518918],[-4.656314849853516,56.056989922837026],[-4.654941558837891,56.05682218458321],[-4.653439521789551,56.057013885385146],[-4.650392532348633,56.0574931332209],[-4.6489763259887695,56.057349359495554],[-4.646787643432617,56.05739728413023],[-4.644513130187988,56.057061810436764],[-4.643740653991699,56.057708792803886],[-4.642667770385742,56.05921837611531],[-4.641079902648926,56.059721557420005],[-4.637389183044434,56.060009086646055],[-4.635801315307617,56.059386103946444],[-4.634342193603516,56.05866726524759],[-4.632625579833984,56.05766086855634],[-4.631466865539551,56.056342928409165],[-4.629964828491211,56.0554083617389],[-4.631638526916504,56.05531250746652],[-4.633312225341797,56.053970522637805],[-4.635372161865234,56.05274831725458],[-4.637560844421387,56.05253262993121],[-4.638848304748535,56.0524846992511]]',6,1,'2017-12-19 21:35:05'),
	(28,'Endrick Balmaha','A windy river route, this will take you back to Balmaha.\r\nMore info can go here, suitable for beginners.',1,6.45563,'[[-4.494137763977051,56.06381864648408],[-4.495596885681152,56.06381864648408],[-4.499630928039551,56.06506445858916],[-4.501347541809082,56.065447777291574],[-4.504265785217285,56.06772365359091],[-4.5053815841674805,56.06722057671354],[-4.505081176757812,56.06623836007839],[-4.503965377807617,56.065567563604446],[-4.503364562988281,56.06480092477037],[-4.503836631774902,56.063938437858944],[-4.504737854003906,56.06317176662807],[-4.504480361938477,56.06221340615006],[-4.503235816955566,56.06187797435485],[-4.501433372497559,56.06183005528876],[-4.4997167587280265,56.06137482119043],[-4.500317573547363,56.06015285045505],[-4.501433372497559,56.05919441493701],[-4.505252838134766,56.05859538064068],[-4.506583213806152,56.05885895687755],[-4.507098197937012,56.06087166146001],[-4.51014518737793,56.06115918210996],[-4.510960578918457,56.06274050736091],[-4.512290954589844,56.06374677148051],[-4.513492584228516,56.06535194797327],[-4.515037536621094,56.066477927418944],[-4.517397880554199,56.06729244524084],[-4.522333145141602,56.070550344429684],[-4.524822235107422,56.07160431168503],[-4.527268409729004,56.07179593899864],[-4.528770446777344,56.07222709697081],[-4.5295000076293945,56.072921730225225],[-4.532632827758789,56.07481394351668],[-4.533748626708984,56.07764011440094],[-4.536838531494141,56.079987115723306],[-4.54310417175293,56.081328195152],[-4.547052383422852,56.08257344139686],[-4.5481038093566895,56.083495376628434]]',6,1,'2017-12-19 21:35:05'),
	(29,'West to Balmaha','This is a long route and will take you from west loch lomond, all the way back to Balmaha.\r\nTaking in all of the major islands, this is a lovely scenic route.',3,7.49349,'[[-4.639492034912109,56.092150913170656],[-4.634170532226562,56.090427143991526],[-4.629836082458496,56.09150450876963],[-4.627776145935059,56.092629724250784],[-4.625072479248047,56.09289306780745],[-4.620652198791504,56.09205515024028],[-4.618120193481444,56.09121721444221],[-4.617605209350585,56.0900440736966],[-4.617905616760254,56.089325806624416],[-4.61949348449707,56.08891878267114],[-4.620265960693359,56.087051205861115],[-4.619922637939453,56.085399043201775],[-4.6166181564331055,56.08417783395281],[-4.614601135253906,56.085039868029554],[-4.61322784423828,56.08590188281681],[-4.610481262207031,56.08506381314523],[-4.608421325683594,56.084345453200676],[-4.6034860610961905,56.085494822682115],[-4.6012115478515625,56.08477647077487],[-4.598894119262695,56.08448912626121],[-4.598250389099121,56.08405810547209],[-4.592628479003906,56.08171135212946],[-4.587306976318359,56.083004478796724],[-4.582328796386719,56.08511170333191],[-4.577608108520508,56.08602160556727],[-4.5696258544921875,56.08913426647632],[-4.563360214233398,56.08970888406312],[-4.558811187744141,56.08894272537568],[-4.552116394042969,56.08496803259323],[-4.549970626831055,56.08381864739435],[-4.548168182373047,56.083537282251115]]',6,1,'2017-12-19 21:35:05');

/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(65) NOT NULL DEFAULT '',
  `lname` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `last_signin` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `last_signin`)
VALUES
	(1,'Chris','Connor','chris@chrisconnor.co.uk','password',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
