-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Kwi 2016, 10:31
-- Wersja serwera: 10.1.10-MariaDB
-- Wersja PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `testcs`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `addresses`
--

CREATE TABLE `addresses` (
  `id_adress` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_house` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_local` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `addresses`
--

INSERT INTO `addresses` (`id_adress`, `city`, `province`, `country`, `postal_code`, `street`, `number_house`, `number_local`) VALUES
(1, '', '', '', '', '', '', ''),
(2, '', '', '', '', '', '', ''),
(3, '', '', '', '', '', '', ''),
(4, '', '', '', '', '', '', ''),
(5, '', '', '', '', '', '', ''),
(6, '', '', '', '', '', '', ''),
(7, '', '', '', '', '', '', ''),
(8, '', '', '', '', '', '', ''),
(9, '', '', '', '', '', '', ''),
(10, '', '', '', '', '', '', ''),
(11, '', '', '', '', 'fhjgfhgf', '', ''),
(12, '', '', '', '', '', '', ''),
(13, '', '', '', '', '', '', ''),
(14, '', '', '', '', '', '', ''),
(15, '', '', '', '', '', '', ''),
(16, '', '', '', '', '', '', ''),
(17, '', '', '', '', '', '', ''),
(18, '', '', '', '', '', '', ''),
(19, '', '', '', '', '', '', ''),
(20, '', '', '', '', '', '', ''),
(21, '', '', '', '', '', '', ''),
(22, '', '', '', '', '', '', ''),
(23, '', '', '', '', '', '', ''),
(24, '', '', '', '', '', '', ''),
(25, '', '', '', '', '', '', ''),
(26, '', '', '', '', '', '', ''),
(27, '', '', '', '', '', '', ''),
(28, '', '', '', '', '', '', ''),
(29, '', '', '', '', '', '', ''),
(30, '', '', '', '', '', '', ''),
(31, '', '', '', '', '', '', ''),
(32, '', '', '', '', '', '', ''),
(33, 'Poznań', 'wielkopolskie', 'Polska', '54-551', 'Marcinkowska', '35', '4'),
(34, '', 'wielkopolskie', 'Poland', '56456', 'fgdfgdfg', '', ''),
(35, '', '', '', '', '', '', ''),
(36, '', '', '', '', '', '', ''),
(37, '', '', '', '', '', '', ''),
(38, '', '', '', '', '', '', ''),
(39, '', '', '', '', '', '', ''),
(40, '', '', '', '', '', '', ''),
(41, 'Poznań', 'wielkopolskie', 'Polska', '53-443', 'Szamo', '35', '4'),
(42, '', '', '', '', '', '', ''),
(43, '', '', '', '', '', '', ''),
(44, '', '', '', '', '', '', ''),
(45, '', '', '', '', '', '', ''),
(46, '', '', '', '', '', '', ''),
(47, '', '', '', '', '', '', ''),
(48, '', '', '', '', '', '', ''),
(49, '', '', '', '', '', '', ''),
(50, '', '', '', '', '', '', ''),
(51, 'Poznań', 'wielkopolskie', 'Polska', '64-332', 'Serafitek', '32', '2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptions` text COLLATE utf8_unicode_ci,
  `description2` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id_category`, `name`, `descriptions`, `description2`) VALUES
(1, 'Rowery miejskie', NULL, 'Rowery miejskie stanowią doskonałą propozycję dla miłośników codziennych wypraw po ośrodkach miejskich, ale śmiało można je zaproponować również entuzjastom popołudniowych przejażdżek. Oferowane przez nasz sklep modele rowerów miejskich odznaczają się niezawodnością i bezpieczeństwem, a dzięki starannie zaprojektowanym konstrukcjom zapewniają maksimum komfortu i wygody. Większość dostępnych rowerów posiada bogate wyposażenie, takie jak błotniki, oświetlenie czy bagażnik.'),
(2, 'Rowery górskie', NULL, 'Rowery górskie na dużych, 29-calowych kołach znakomicie pokonują przeszkody na trudnych ścieżkach. Większa powierzchnia styku opony z podłożem sprawia, że 29ery nie zapadają się w grząskim czy piaszczystym terenie i umożliwiają swobodny przejazd tam, gdzie rower na kołach 26-calowych może mieć problemy. Większe koła sprawiają, że baza kół, czyli długość roweru, jest większa, co nieco zmniejsza zwrotność. Poza najbardziej krętymi singletrackami jest jednak w zupełności wystarczająca na większości szlaków. Rewelacyjna przyczepność i łatwość przejazdu nawet przez duże kamienie czy korzenie sprawia, że 29er to świetny towarzysz większości terenowych podróży. Warto pamiętać, że dobierając rozmiar ramy, zwykle należy się zastanowić nad mniejszym rozmiarem, niż w przypadku odpowiadającego nam, klasycznego roweru na kołach 26'),
(3, 'Rowery trekkingowe', NULL, 'Rowery trekkingowe prezentowane w naszej ofercie stanowią znakomite rozwiązanie dla osób lubiących dłuższe wyprawy. Specjalna konstrukcja roweru oraz odpowiednie wyposażenie dodatkowe czynią z tego jednośladowego pojazdu rewelacyjnego partnera na wypady za miasto, po drogach nie tylko asfaltowych.  Właściwości, jakimi odznaczają się rowery trekkingowe to między innymi odpowiednie amortyzatory, solidna rama o właściwej geometrii oraz wygodne siodełko. Istotną rolę w przypadku tego rodzaju rowerów odgrywają również takie akcesoria jak błotniki, bagażnik (lub sakwy), czy też lampki na dynamo. Wszystko to razem powoduje, że jazda rowerem trekkingowym jest bezpieczna oraz komfortowa również podczas gorszej pogody bądź po zmroku. Rowery trekkingowe oferujemy w sprzedaży internetowej oraz bezpośredniej. Zapraszamy do naszego sklepu stacjonarnego – Poznań, ul. Mostowa 39.'),
(4, 'Rowery szosowe', NULL, 'Przystępne cenowo rowery szosowe. Rowery szosowe są dedykowane wszystkim tym osobom, które chcą szybko pokonywać duże dystanse w krótkim czasie. Ich charakterystyczną cechą jest kierownica zgięta w dół, która umożliwia przyjęcie jeszcze bardziej aerodynamicznej pozycji. Ten typ rowerów świetnie sprawdzi się głównie do jazdy po drogach utwardzonych (asfaltowych). Osobom, które są zainteresowane kupnem tego rodzaju modelów, polecamy zapoznanie się z działem wyprzedaż, w którym można znaleźć szosówki w wyjątkowo niskich cenach.'),
(5, 'Rowery dziecięce', NULL, 'Rowery dziecięce – dla małych cyklistów. Znajdujące się w asortymencie naszego sklepu rowery dziecięce pochodzą od cenionych na rynku producentów, którzy zadbali o to, by sprzęt dla małych cyklistów odznaczał się bezpieczeństwem oraz konstrukcją dostosowaną do anatomii kilkulatków. Proponowane przez nas rowery dla dzieci zapewniają wysoki komfort jazdy, przykuwając uwagę ciekawą, kolorową stylistyką. Maluchy swoją przygodę z jazdą na rowerze mogą rozpocząć z modelami takich firm, jak Kross czy Grand.'),
(6, 'Rowery crossowe', NULL, 'Główną zaletą rowerów crossowych jest ich bardzo duża uniwersalność. Rowery te gwarantują niskie opory toczenia na utwardzonych drogach oraz stosunkowo dobrze poczynają sobie w nietrudnym terenie. Radzą sobie na szerokim spektrum ścieżek, wyłączając tylko trudne technicznie trasy oraz silnie piaszczyste drogi. Pozycja zajmowana przez rowerzystę jest pewnym kompromisem między wydajnością i wygodą. Rowery crossowe mogą być łatwo wyposażone w dodatkowy osprzęt taki jak błotniki, bagażnik czy oświetlenie i stać się dogodnym środkiem komunikacji, choćby do dojazdów do pracy czy szkoły w mieście. Dobrze sprawdzają się także w turystyce rowerowej. Jeżeli będzie to Twój jedyny rower - prawdopodobnie crossówka będzie bardzo dobrym wyborem.'),
(7, 'Części rowerowe', NULL, 'Części rowerowe to elementy, które w dużym stopniu decydują o zwrotności, dynamice, a także o komforcie prowadzenia roweru. By mieć pewność, że nasz rower będzie sprzyjał bezpiecznej jeździe nawet na długie dystanse, warto sięgnąć po części do rowerów pochodzące od sprawdzonych producentów, takich jak Shimano, Kross, De One czy Neco. Dobre jakościowo hamulce, przerzutki, obręcze czy zębatki to doskonały wybór do rowerów trekkingowych, crossowych, górskich oraz miejskich.'),
(8, 'Odzież i rękawiczki', NULL, 'Podstawowy ubiór każdego rowerzysty'),
(9, 'Akcesoria rowerowe', NULL, 'Niezależnie od tego, czy rower wykorzystuje się w celach rekreacyjnych, sportowych, czy też jako środek do codziennego transportu, niezwykle istotne jest, aby posiadać do niego odpowiednie akcesoria. Tylko właściwie dobrane oraz solidne akcesoria rowerowe pozwolą bowiem w bezpieczny oraz komfortowy sposób przemierzać każdego rodzaju trasę. W obecnych czasach, producenci z branży rowerowej oferują tak ogromny repertuar produktów, że nie jeden pasjonat jednośladów może mieć trudności z ich optymalnym wyborem. Dlatego też, gdy zamierza się zakupić akcesoria do roweru, warto zdać się na pomoc ekspertów, którzy doradzą oraz podpowiedzą najlepsze rozwiązania, dopasowane do indywidualnych oczekiwań oraz predyspozycji finansowych danej osoby. O szerokim wyborze dostępnych współcześnie akcesoriów do rowerów, jak również o wartości profesjonalnej pomocy przy ich wyborze, przekonali się z pewnością wszyscy Klienci naszego sklepu. Zarówno w sprzedaży internetowej, jak również w naszej siedzibie w Poznaniu, udostępniamy niezwykle duży wybór różnego rodzaju artykułów rowerowych. Znajdują się tam akcesoria wpływające na bezpieczeństwo jazdy, poprawiające jej komfort czy czyniące podróżowanie rowerem jeszcze bardziej atrakcyjnym. Klientom oferujemy między innymi profesjonalne oświetlenie, foteliki dziecięce bądź też dzwonki. Osoby pragnące poprawić wygodę jazdy, zaopatrzyć się mogą w specjalne siodełka, koszyki lub sakwy. Natomiast takie akcesoria do roweru, jak nowoczesne liczniki dadzą możliwość lepszego kontrolowania tras przemierzanych rowerem. Tym co doceniają nasi Klienci jest jednakże nie tylko szeroki asortyment, jaki przedstawiamy. Każdy specjalista z teamu Bikefun zaoferować może bowiem profesjonalne wsparcie przy zakupie akcesoriów, które zostaną dobrane idealnie do wymagań konkretnego Klienta');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `id_adress` int(11) DEFAULT NULL,
  `id_contact` int(11) DEFAULT NULL,
  `user_login` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `md5_pass` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_rejestracji` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `privileges` int(11) DEFAULT NULL,
  `date_last_logged` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `client`
--

INSERT INTO `client` (`id_client`, `id_adress`, `id_contact`, `user_login`, `md5_pass`, `name`, `nip`, `client_type`, `data_rejestracji`, `surname`, `privileges`, `date_last_logged`) VALUES
(1, 25, 22, 'adam', 'adam', '', '', 'standard', '2016-02-22 18:08:48', '', 1, NULL),
(2, 26, 23, 'kamila', 'kamila', '', '', 'standard', '2016-02-22 18:12:56', '', 1, NULL),
(3, 27, 24, 'kamila123', 'kamila123', '', '', 'standard', '2016-02-22 18:14:10', '', 1, NULL),
(4, 28, 25, 'kamila12365', 'kamila12365', '', '', 'standard', '2016-02-22 18:15:05', '', 1, NULL),
(5, 29, 26, 'kamila1236545', 'kamila1236545', '', '', 'standard', '2016-02-22 18:16:29', '', 1, NULL),
(6, 30, 27, 'adasdads', 'adasdads', '', '', 'standard', '2016-02-22 18:22:20', '', 1, NULL),
(7, 31, 28, 'mati', 'mati', '', '', 'standard', '2016-02-29 09:37:16', '', 1, NULL),
(8, 32, 29, 'hh', '1qaz1qaz', 'l;kk', '', 'standard', '2016-03-03 22:02:59', 'hh', 1, NULL),
(9, 33, 30, 'piotr.siupa', 'abc', 'Siupa', '43254354354', 'standard', '2016-03-05 01:33:18', 'Piotr', 1, NULL),
(10, 34, 31, 'rhfghfgyhrt54', 'huj', 'fghfghfgh', '', 'standard', '2016-03-07 12:46:31', 'fghfgh', 1, NULL),
(11, 35, 32, 'kacper', 'kacper', 'Jerz', '', 'standard', '2016-03-08 17:14:40', 'Krzysiek', 1, NULL),
(12, 36, 33, 'basia', 'basia', '', '', 'standard', '2016-03-09 23:40:25', '', 1, NULL),
(13, 37, 34, 'kalik', 'kalik', 'Maciejewski', '', 'standard', '2016-03-10 21:14:33', 'Kali', 1, NULL),
(14, 38, 35, 'kaja', 'kaja', '', '', 'standard', '2016-03-10 22:12:36', '', 1, NULL),
(15, 39, 36, 'abba', 'abba', 'tom', '', 'standard', '2016-03-17 00:31:27', 'Pempera', 1, NULL),
(16, 40, 37, 'dupa', 'dupa', '', '', 'standard', '2016-03-17 08:07:36', '', 1, NULL),
(17, 41, 38, 'lala', 'lala', 'ddakfkdsfk', '234535423', 'standard', '2016-03-17 13:50:06', 'Kdfkafd', 1, NULL),
(18, 42, 39, 'mango', 'mango', 'jj', '', 'standard', '2016-03-19 18:38:40', 'kjkj', 1, NULL),
(19, 43, 40, 'robert', 'robert', 'klk', '', 'standard', '2016-03-19 18:39:42', 'lskfldflkk', 1, NULL),
(20, 44, 41, 'kurwa', 'kurwa', '', '', 'standard', '2016-03-19 18:57:29', '', 1, NULL),
(21, 45, 42, 'polak', 'polak', '', '', 'standard', '2016-03-19 19:12:23', '', 1, NULL),
(22, 46, 43, 'bingo', 'kurwa', '', '', 'standard', '2016-03-19 19:15:35', '', 1, NULL),
(23, 47, 44, 'maestro', 'maestro', '', '', 'standard', '2016-03-19 19:48:56', '', 1, NULL),
(24, 48, 45, 'rower', 'rower123', '', '', 'standard', '2016-03-19 19:57:56', '', 1, NULL),
(25, 49, 46, 'wp', 'wp', 'sdfdf', '', 'standard', '2016-03-19 19:59:21', 'adf', 1, NULL),
(26, 50, 47, 'google', 'google', '', '', 'standard', '2016-03-19 20:02:07', '', 1, NULL),
(27, 51, 48, 'gram24', '950e9e9eea9d17b9a93980674a59d73c', 'Jerzyński', '', 'standard', '2016-03-19 20:29:31', 'Krzysztof', 1, '2016-04-18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `number_telephone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `contact`
--

INSERT INTO `contact` (`id_contact`, `number_telephone`, `fax`, `email`, `site`) VALUES
(1, '', '', '', ''),
(2, '', '', '', ''),
(3, '', '', '', ''),
(4, '', '', '', ''),
(5, '', '', '', ''),
(6, '', '', '', ''),
(7, '', '', '', ''),
(8, '', '', '', ''),
(9, '', '', '', ''),
(10, '', '', '', ''),
(11, '', '', '', ''),
(12, '', '', '', ''),
(13, '', '', '', ''),
(14, '', '', '', ''),
(15, '', '', '', ''),
(16, '', '', '', ''),
(17, '', '', '', ''),
(18, '', '', '', ''),
(19, '', '', '', ''),
(20, '', '', '', ''),
(21, '', '', '', ''),
(22, '', '', '', ''),
(23, '', '', '', ''),
(24, '', '', '', ''),
(25, '', '', '', ''),
(26, '', '', '', ''),
(27, '', '', '', ''),
(28, '', '', '', ''),
(29, '', '', '', ''),
(30, '+48 51 13 019', '245634543', 'adfsf@dfsdf.pl', 'google.pl'),
(31, '5', '67657567', 'feiongfioneoihnrgf9hw@fgdfjnvd', ''),
(32, '', '', 'afdf@fdf.pl', ''),
(33, '', '', '', ''),
(34, '', '', 'adfsf@wp.pl', ''),
(35, '', '', '', ''),
(36, '', '', 'adasd@wp.pl', ''),
(37, '', '', '', ''),
(38, '342123212', '234523434', 'ddfdsf@wp.pl', 'google.pl'),
(39, '', '', 'asdsads@wp.pl', ''),
(40, '', '', 'lksdfsdf@o2.pl', ''),
(41, '', '', '', ''),
(42, '', '', 'afdaf@adfd.pl', ''),
(43, '', '', '', ''),
(44, '', '', '', ''),
(45, '', '', '', ''),
(46, '', '', '', ''),
(47, '', '', 'google@wp.pl', ''),
(48, '', '', 'gram24@wp.pl', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL,
  `id_adress` int(11) DEFAULT NULL,
  `id_contact` int(11) DEFAULT NULL,
  `user_login` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `md5_pass` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `privileges` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `start_of_work` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `code_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_netto_purchase` decimal(10,2) DEFAULT NULL,
  `price_brutto_purchace` decimal(10,2) DEFAULT NULL,
  `vat_purchase` int(11) DEFAULT NULL,
  `date_shipment` date DEFAULT NULL,
  `date_sold` date DEFAULT NULL,
  `is_sold` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `is_accepted` int(11) DEFAULT NULL,
  `is_paid` int(11) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `date_shipment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_realized` int(11) DEFAULT NULL,
  `date_realized_order` date DEFAULT NULL,
  `time_order` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id_order`, `id_client`, `is_accepted`, `is_paid`, `date_order`, `date_shipment`, `is_realized`, `date_realized_order`, `time_order`) VALUES
(1, 5, 0, 0, '2016-02-22', NULL, 0, NULL, ''),
(2, 6, 0, 0, '2016-02-22', NULL, 0, NULL, ''),
(3, 7, 0, 0, '2016-02-29', NULL, 0, NULL, ''),
(4, 8, 0, 0, '2016-03-03', NULL, 0, NULL, ''),
(5, 9, 0, 0, '2016-03-05', NULL, 0, NULL, ''),
(6, 10, 0, 0, '2016-03-07', NULL, 0, NULL, ''),
(7, 11, 0, 0, '2016-03-08', NULL, 0, NULL, ''),
(8, 12, 1, 0, '2016-03-10', NULL, 0, NULL, ''),
(9, 13, 1, 0, '2016-03-10', NULL, 0, NULL, ''),
(10, 12, 1, 0, '2016-03-10', NULL, 0, NULL, ''),
(11, 12, 0, 0, '2016-03-10', NULL, 0, NULL, ''),
(12, 14, 1, 0, '2016-03-10', NULL, 0, NULL, ''),
(13, 14, 0, 0, '2016-03-10', NULL, 0, NULL, ''),
(14, 13, 0, 0, '2016-03-10', NULL, 0, NULL, ''),
(15, 15, 1, 0, '2016-03-17', NULL, 0, NULL, ''),
(16, 15, 1, 0, '2016-03-17', NULL, 0, NULL, ''),
(17, 15, 0, 0, '2016-03-17', NULL, 0, NULL, ''),
(18, 16, 1, 0, '2016-03-17', NULL, 0, NULL, ''),
(19, 16, 0, 0, '2016-03-17', NULL, 0, NULL, ''),
(20, 17, 1, 0, '2016-03-17', NULL, 0, NULL, ''),
(21, 17, 1, 0, '2016-03-17', NULL, 0, NULL, ''),
(22, 17, 1, 0, '2016-03-17', NULL, 0, NULL, ''),
(23, 17, 1, 0, '2016-03-17', NULL, 0, NULL, ''),
(24, 17, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(25, 17, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(26, 17, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(27, 17, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(28, 17, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(29, 17, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(30, 17, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(31, 17, 0, 0, NULL, NULL, 0, NULL, ''),
(32, 19, 0, 0, '2016-03-19', NULL, 0, NULL, ''),
(33, 20, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(34, 20, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(35, 20, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(36, 20, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(37, 20, 1, 0, '0000-00-00', NULL, 0, NULL, ''),
(38, 20, 1, 0, '2016-03-19', NULL, 0, NULL, '18:38:47'),
(39, 21, 1, 0, '0000-00-00', NULL, 0, NULL, '19:12:23'),
(40, 22, 1, 0, '2016-03-19', NULL, 0, NULL, '18:23:19'),
(41, 22, 1, 0, '2016-03-19', '', 0, '0000-00-00', '18:26:28'),
(42, 22, 0, 0, '0000-00-00', '', 0, '0000-00-00', ''),
(43, 20, 0, 0, '0000-00-00', '', 0, '0000-00-00', ''),
(44, 23, 1, 0, NULL, NULL, 0, NULL, '18:49:22'),
(45, 23, 1, 0, '0000-00-00', '', 0, '0000-00-00', '18:51:12'),
(46, 23, 1, 0, '0000-00-00', '', 0, '0000-00-00', '18:53:15'),
(47, 23, 1, 0, '0000-00-00', '', 0, '0000-00-00', '18:53:55'),
(48, 23, 1, 0, '0000-00-00', '', 0, '0000-00-00', '18:56:08'),
(49, 23, 0, 0, '0000-00-00', '', 0, '0000-00-00', ''),
(50, 25, 0, 0, NULL, NULL, 0, NULL, NULL),
(51, 26, 1, 0, '2016-03-19', NULL, 0, NULL, '19:02:52'),
(52, 26, 1, 0, '2016-03-19', '', 0, '0000-00-00', '19:09:43'),
(53, 26, 1, 0, '2016-03-19', '', 0, '0000-00-00', '19:13:34'),
(54, 26, 0, 0, '0000-00-00', '', 0, '0000-00-00', ''),
(55, 27, 1, 0, '2016-03-19', NULL, 0, NULL, '19:30:12'),
(56, 27, 1, 0, '2016-03-19', '', 0, '0000-00-00', '19:30:41'),
(57, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '23:02:17'),
(58, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '00:52:27'),
(59, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '00:57:58'),
(60, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '01:04:00'),
(61, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '01:20:44'),
(62, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '01:22:36'),
(63, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '18:02:58'),
(64, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '18:03:52'),
(65, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '18:04:36'),
(66, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '18:07:10'),
(67, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '18:07:56'),
(68, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '18:08:47'),
(69, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '18:48:02'),
(70, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '18:48:33'),
(71, 27, 1, 0, '2016-03-20', '', 0, '0000-00-00', '18:49:50'),
(72, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '23:08:35'),
(73, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '23:18:16'),
(74, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '23:19:29'),
(75, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '23:22:08'),
(76, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '23:27:46'),
(77, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '23:41:41'),
(78, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '23:59:04'),
(79, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:01:35'),
(80, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:03:10'),
(81, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:19:32'),
(82, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:22:29'),
(83, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:23:17'),
(84, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:25:35'),
(85, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:26:47'),
(86, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:28:55'),
(87, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:29:25'),
(88, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:29:53'),
(89, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:32:02'),
(90, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '00:34:11'),
(91, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '08:54:39'),
(92, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '09:14:03'),
(93, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '09:30:57'),
(94, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '09:50:01'),
(95, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '09:50:46'),
(96, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '09:54:55'),
(97, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '11:07:18'),
(98, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '11:08:54'),
(99, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '11:09:21'),
(100, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '11:09:55'),
(101, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '11:12:04'),
(102, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '11:25:44'),
(103, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '11:27:25'),
(104, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '11:28:27'),
(105, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '13:51:11'),
(106, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '13:53:33'),
(107, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '13:56:21'),
(108, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '14:00:23'),
(109, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '14:01:09'),
(110, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '14:02:12'),
(111, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '14:03:21'),
(112, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '15:00:58'),
(113, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '15:02:13'),
(114, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '15:03:13'),
(115, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '17:05:58'),
(116, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '17:13:51'),
(117, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '17:15:08'),
(118, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '17:19:27'),
(119, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '17:20:44'),
(120, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '17:24:18'),
(121, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '17:26:33'),
(122, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '17:28:02'),
(123, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '21:20:29'),
(124, 27, 0, 0, '0000-00-00', '', 0, '0000-00-00', ''),
(125, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '22:12:37'),
(126, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '22:14:55'),
(127, 27, 1, 0, '2016-03-21', '', 0, '0000-00-00', '22:24:55'),
(128, 27, 1, 0, '2016-03-22', '', 0, '0000-00-00', '07:45:43'),
(129, 27, 1, 0, '2016-03-22', '', 0, '0000-00-00', '07:47:39'),
(130, 27, 1, 0, '2016-04-11', '', 0, '0000-00-00', '07:54:12'),
(131, 27, 0, 0, '0000-00-00', '', 0, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ordersproducts`
--

CREATE TABLE `ordersproducts` (
  `id_orders_products` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `amount_products` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `ordersproducts`
--

INSERT INTO `ordersproducts` (`id_orders_products`, `id_order`, `id_product`, `amount_products`) VALUES
(4, 5, 4, 1),
(5, 5, 5, 1),
(6, 7, 2, NULL),
(8, 8, 2, 3),
(9, 9, 4, 1),
(10, 8, 4, 3),
(11, 10, 2, 2),
(12, 11, 2, NULL),
(13, 12, 2, 1),
(14, 9, 2, 1),
(15, 15, 5, 2),
(17, 16, 4, 1),
(18, 18, 2, 1),
(19, 20, 2, 1),
(20, 20, 5, 4),
(21, 21, 2, 1),
(22, 22, 2, 1),
(23, 23, 2, 2),
(24, 24, 4, 2),
(25, 25, 5, 1),
(26, 26, 5, 1),
(27, 27, 5, 1),
(28, 28, 5, 4),
(29, 29, 2, 4),
(30, 30, 2, 1),
(33, 33, 2, 1),
(34, 34, 5, 1),
(35, 35, 5, 4),
(36, 36, 5, 4),
(37, 37, 5, 4),
(38, 38, 2, 2),
(39, 39, 5, 1),
(40, 40, 4, 1),
(41, 41, 5, 4),
(42, 44, 5, 1),
(43, 45, 5, 1),
(44, 46, 4, 1),
(45, 47, 4, 4),
(46, 48, 5, 3),
(47, 51, 2, 1),
(48, 52, 2, 1),
(49, 52, 4, 2),
(50, 53, 2, 6),
(52, 55, 5, 1),
(53, 55, 4, 3),
(54, 56, 2, 1),
(55, 57, 2, 7),
(56, 58, 5, 1),
(57, 59, 5, 1),
(58, 60, 4, 1),
(59, 61, 5, 1),
(60, 62, 2, 1),
(61, 63, 4, 1),
(62, 64, 2, 1),
(63, 65, 2, 5),
(64, 66, 5, 1),
(65, 67, 2, 5),
(66, 68, 2, 1),
(67, 69, 4, 3),
(68, 70, 5, 1),
(69, 71, 5, 3),
(70, 72, 4, 1),
(71, 73, 5, 1),
(72, 74, 2, 1),
(73, 75, 5, 1),
(74, 76, 5, 1),
(75, 77, 5, 1),
(76, 78, 2, 3),
(77, 79, 5, 5),
(78, 80, 5, 1),
(79, 81, 5, 1),
(80, 82, 5, 1),
(81, 82, 2, 1),
(82, 83, 2, 1),
(83, 84, 2, 1),
(84, 85, 2, 1),
(85, 86, 2, 1),
(86, 87, 2, 1),
(87, 88, 5, 4),
(88, 89, 5, 1),
(89, 90, 5, 1),
(90, 91, 2, 1),
(91, 92, 2, 1),
(92, 93, 5, 1),
(93, 94, 2, 1),
(94, 95, 2, 1),
(95, 96, 4, 1),
(96, 97, 5, 1),
(97, 98, 2, 1),
(98, 99, 2, 1),
(99, 100, 5, 1),
(100, 101, 2, 3),
(101, 102, 5, 1),
(102, 103, 5, 1),
(103, 104, 5, 1),
(104, 105, 5, 4),
(105, 106, 5, 4),
(106, 107, 5, 3),
(107, 108, 2, 1),
(108, 109, 2, 1),
(109, 110, 2, 1),
(110, 111, 5, 3),
(111, 112, 2, 4),
(112, 112, 5, 3),
(113, 113, 2, 2),
(114, 113, 5, 4),
(115, 114, 4, 1),
(116, 115, 5, 1),
(117, 116, 5, 1),
(118, 116, 2, 1),
(119, 117, 2, 1),
(120, 118, 2, 1),
(121, 119, 4, 1),
(122, 120, 5, 1),
(123, 121, 2, 1),
(124, 122, 2, 1),
(125, 123, 2, 1),
(126, 125, 5, 1),
(127, 126, 2, 1),
(132, 127, 5, 2),
(133, 128, 2, 1),
(134, 129, 5, 1),
(135, 130, 5, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photogallery`
--

CREATE TABLE `photogallery` (
  `id_photo` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_add` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `positionsalesinvoice`
--

CREATE TABLE `positionsalesinvoice` (
  `id_position_si` int(11) NOT NULL,
  `id_sales_invoice` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `price_netto_sales` decimal(10,2) DEFAULT NULL,
  `price_brutto_sales` decimal(10,2) DEFAULT NULL,
  `vat_sales` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `producer`
--

CREATE TABLE `producer` (
  `id_producer` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description2` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `producer`
--

INSERT INTO `producer` (`id_producer`, `name`, `regon`, `nip`, `telephone`, `description2`) VALUES
(1, 'Kross', '2483587357', '29489252', '+48 726 761 841', NULL),
(2, 'Kross', '2483587357', '29489252', '+48 726 761 841', NULL),
(3, 'De One', '2483587357', '29489252', '+48 726 761 841', NULL),
(4, 'Continental', '2483587357', '29489252', '+48 726 761 841', NULL),
(5, 'Bosh', '2483587357', '29489252', '+48 726 761 841', NULL),
(6, 'The Best', '2483587357', '29489252', '+48 726 761 841', NULL),
(7, 'Americano', '2483587357', '29489252', '+48 726 761 841', NULL),
(8, 'Corratec', '934123434', '87494999', '+48 943 123 551', NULL),
(9, 'Unibike', '219423351', '261371542', '+48 175 135 129', NULL),
(10, 'Grand', '246161461', '951363124', '+48 295 129 123', NULL),
(11, 'Shimano', '268234123', '171236123', '+48 168 126 883', NULL),
(12, 'Neco', '342442092', '184112331', '+48 822 851 812', NULL),
(13, 'CTS', '112334554', '812128231', '+48 881 841 932', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_producer` int(11) DEFAULT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descriptions` text COLLATE utf8_unicode_ci,
  `photography` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_netto` decimal(10,2) DEFAULT NULL,
  `price_brutto` decimal(10,2) DEFAULT NULL,
  `percent_vat` decimal(5,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `date_add_products` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `id_producer`, `name_product`, `descriptions`, `photography`, `price_netto`, `price_brutto`, `percent_vat`, `discount`, `amount`, `date_add_products`) VALUES
(2, 9, 1, 'Pedały Shimano SPD M520', '\r\n    Oś ze stali Cr-mo<br />\r\n    Zintegrowane odblaski<br />\r\n    Korpus z tworzywa sztucznego<br />\r\n', 'img/pedaly-shimano-spd-m520.jpg', '14.00', '17.08', '22.00', '0.00', 10, '2016-02-15'),
(4, 2, 2, 'Pompka Kross Tornado', 'Materiał: aluminium 6063 <br />\r\nZawór: F/V, A/V, D/V (przez przełożenie uszczelki)<br />\r\nCiśnienie: 160 psi<br />\r\nInformacje dodatkowe: wysoko umiejscowiony manometr, dźwignia blokująca, ergonomiczna rączka<br />\r\nWaga: 880 g<br />\r\nDługość: 61 cm<br />\r\nKolor: srebrny<br />', 'img/pompka-kross-tornado.jpg', '99.00', '120.78', '22.00', '5.00', 20, '2016-03-01'),
(5, 4, 3, 'Kross Moon 3.0 2016', 'Rama 	Aluminium Super Lite <br />\r\nWidelec 	RockShox Recon Silver Solo Air (skok 130mm, stożkowa rura sterowa główka, QR15)<br />\r\nTylny amortyzator 	-<br />\r\nIlość biegów 	27<br />\r\nPrzerzutka przód 	Shimano Acera FD-M3000<br />\r\nPrzerzutka tył 	Shimano Alivio RD-M4000<br />\r\nHamulec przód 	Avid DB1 (hydrauliczny, tarcza 180mm)<br />\r\nHamulec tył 	Avid DB1 (hydrauliczny, tarcza 180mm)<br />\r\nDźwignie hamulca 	Avid DB1<br />\r\nManetki 	Shimano Altus SL-M370, 9 biegów<br />\r\nKorby 	Suntour XCM410 40/30/22T<br />\r\nŁańcuch 	Shimano CN-HG53<br />\r\nKaseta / Wolnobieg 	Shimano Alivio CS-HG300-9 12-36T<br />\r\nPiasta przód 	Shimano Deore HB-M618 15x100mm<br />\r\nPiasta tył 	Shimano Deore FH-M618 12x142mm<br />\r\nOpony 	Shwalbe Nobby Nic Performance 27,5"x2,25<br />\r\nObręcze 	WTB STP i23 27,5" Tubeless Ready<br />\r\nKierownica 	Kross Racing Components (Aluminium, niski wznios 760mm 35mm)<br />\r\nWspornik kierownicy 	Kross Racing Components (Aluminium, ahead, 35mm)<br />\r\nWspornik siodła 	Kross Racing Components (Aluminium, 30,9mm)<br />\r\nStery 	VP A45AC3 pół- zintegrowane<br />\r\nSiodło 	Kross VL-1489<br />\r\nChwyty 	Kross<br />\r\nPedały 	-<br />\r\nWaga 	13.6<br />\r\nUwagi 	-<br />', 'img/kross-moon-30.jpg', '14500.00', '17690.00', '22.00', '0.00', 20, '2016-04-11');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products_has_tag`
--

CREATE TABLE `products_has_tag` (
  `id_product` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `products_has_tag`
--

INSERT INTO `products_has_tag` (`id_product`, `id_tag`) VALUES
(2, 2),
(2, 6),
(2, 7),
(2, 10),
(4, 0),
(4, 8),
(4, 9),
(4, 10),
(5, 0),
(5, 1),
(5, 3),
(5, 11),
(5, 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `idProduktu` int(11) NOT NULL,
  `Nazwa` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`idProduktu`, `Nazwa`) VALUES
(1, 'Jablko'),
(2, 'pomarancza'),
(3, 'mandarynka'),
(4, 'jagoda'),
(5, 'lesne grzyby'),
(6, 'morela'),
(7, 'brzoskwinia'),
(8, 'lesna jagoda');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `salesinvoice`
--

CREATE TABLE `salesinvoice` (
  `id_sales_invoice` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `number_facture` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `method_payment` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_document` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_sales` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_vat` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_netto` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_brutto` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL,
  `name_tag` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `tag`
--

INSERT INTO `tag` (`id_tag`, `name_tag`) VALUES
(12, '2016'),
(10, 'aluminium'),
(4, 'Continental'),
(0, 'kross'),
(11, 'Moon 3.0'),
(3, 'najlepsze_rowery'),
(5, 'okazja'),
(6, 'peda?y'),
(8, 'pompka'),
(1, 'rower'),
(2, 'Shimano'),
(7, 'SPD M520'),
(9, 'Tornado');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id_adress`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_adress` (`id_adress`),
  ADD KEY `id_contact` (`id_contact`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD KEY `id_adress` (`id_adress`),
  ADD KEY `id_contact` (`id_contact`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `ordersproducts`
--
ALTER TABLE `ordersproducts`
  ADD PRIMARY KEY (`id_orders_products`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `photogallery`
--
ALTER TABLE `photogallery`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `positionsalesinvoice`
--
ALTER TABLE `positionsalesinvoice`
  ADD PRIMARY KEY (`id_position_si`),
  ADD KEY `id_sales_invoice` (`id_sales_invoice`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `producer`
--
ALTER TABLE `producer`
  ADD PRIMARY KEY (`id_producer`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_producer` (`id_producer`);

--
-- Indexes for table `products_has_tag`
--
ALTER TABLE `products_has_tag`
  ADD PRIMARY KEY (`id_product`,`id_tag`),
  ADD KEY `fk_products_has_tag_tag1_idx` (`id_tag`),
  ADD KEY `fk_products_has_tag_products1_idx` (`id_product`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`idProduktu`);

--
-- Indexes for table `salesinvoice`
--
ALTER TABLE `salesinvoice`
  ADD PRIMARY KEY (`id_sales_invoice`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`),
  ADD UNIQUE KEY `id_tag_UNIQUE` (`id_tag`),
  ADD UNIQUE KEY `name_UNIQUE` (`name_tag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id_adress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT dla tabeli `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT dla tabeli `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT dla tabeli `ordersproducts`
--
ALTER TABLE `ordersproducts`
  MODIFY `id_orders_products` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT dla tabeli `photogallery`
--
ALTER TABLE `photogallery`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `positionsalesinvoice`
--
ALTER TABLE `positionsalesinvoice`
  MODIFY `id_position_si` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `producer`
--
ALTER TABLE `producer`
  MODIFY `id_producer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `idProduktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `salesinvoice`
--
ALTER TABLE `salesinvoice`
  MODIFY `id_sales_invoice` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `Client_ibfk_1` FOREIGN KEY (`id_adress`) REFERENCES `addresses` (`id_adress`),
  ADD CONSTRAINT `Client_ibfk_2` FOREIGN KEY (`id_contact`) REFERENCES `contact` (`id_contact`);

--
-- Ograniczenia dla tabeli `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `Employee_ibfk_1` FOREIGN KEY (`id_adress`) REFERENCES `addresses` (`id_adress`),
  ADD CONSTRAINT `Employee_ibfk_2` FOREIGN KEY (`id_contact`) REFERENCES `contact` (`id_contact`);

--
-- Ograniczenia dla tabeli `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `Item_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Ograniczenia dla tabeli `ordersproducts`
--
ALTER TABLE `ordersproducts`
  ADD CONSTRAINT `OrdersProducts_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `OrdersProducts_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Ograniczenia dla tabeli `photogallery`
--
ALTER TABLE `photogallery`
  ADD CONSTRAINT `Photogallery_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Ograniczenia dla tabeli `positionsalesinvoice`
--
ALTER TABLE `positionsalesinvoice`
  ADD CONSTRAINT `PositionSalesInvoice_ibfk_1` FOREIGN KEY (`id_sales_invoice`) REFERENCES `salesinvoice` (`id_sales_invoice`),
  ADD CONSTRAINT `PositionSalesInvoice_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`);

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `Products_ibfk_2` FOREIGN KEY (`id_producer`) REFERENCES `producer` (`id_producer`);

--
-- Ograniczenia dla tabeli `products_has_tag`
--
ALTER TABLE `products_has_tag`
  ADD CONSTRAINT `fk_products_has_tag_products1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_has_tag_tag1` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `salesinvoice`
--
ALTER TABLE `salesinvoice`
  ADD CONSTRAINT `SalesInvoice_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
