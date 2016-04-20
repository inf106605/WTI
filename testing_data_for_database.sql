-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Kwi 2016, 12:41
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

--
-- Zrzut danych tabeli `addresses`
--

INSERT INTO `addresses` (`id_adress`, `city`, `province`, `country`, `postal_code`, `street`, `number_house`, `number_local`) VALUES
(41, 'Poznań', 'wielkopolskie', 'Polska', '64-500', 'Serafitek', '32', '2');

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id_category`, `name`, `description2`) VALUES
(10, 'Rowery miejskie', 'Rowery miejskie stanowią doskonałą propozycję dla miłośników codziennych wypraw po ośrodkach miejskich, ale śmiało można je zaproponować również entuzjastom popołudniowych przejażdżek. Oferowane przez nasz sklep modele rowerów miejskich odznaczają się niezawodnością i bezpieczeństwem, a dzięki starannie zaprojektowanym konstrukcjom zapewniają maksimum komfortu i wygody. Większość dostępnych rowerów posiada bogate wyposażenie, takie jak błotniki, oświetlenie czy bagażnik.'),
(11, 'Rowery górskie', 'Rowery górskie na dużych, 29-calowych kołach znakomicie pokonują przeszkody na trudnych ścieżkach. Większa powierzchnia styku opony z podłożem sprawia, że 29ery nie zapadają się w grząskim czy piaszczystym terenie i umożliwiają swobodny przejazd tam, gdzie rower na kołach 26-calowych może mieć problemy. Większe koła sprawiają, że baza kół, czyli długość roweru, jest większa, co nieco zmniejsza zwrotność. Poza najbardziej krętymi singletrackami jest jednak w zupełności wystarczająca na większości szlaków. Rewelacyjna przyczepność i łatwość przejazdu nawet przez duże kamienie czy korzenie sprawia, że 29er to świetny towarzysz większości terenowych podróży. Warto pamiętać, że dobierając rozmiar ramy, zwykle należy się zastanowić nad mniejszym rozmiarem, niż w przypadku odpowiadającego nam, klasycznego roweru na kołach 26'),
(12, 'Rowery trekkingowe', 'Rowery trekkingowe prezentowane w naszej ofercie stanowią znakomite rozwiązanie dla osób lubiących dłuższe wyprawy. Specjalna konstrukcja roweru oraz odpowiednie wyposażenie dodatkowe czynią z tego jednośladowego pojazdu rewelacyjnego partnera na wypady za miasto, po drogach nie tylko asfaltowych.  Właściwości, jakimi odznaczają się rowery trekkingowe to między innymi odpowiednie amortyzatory, solidna rama o właściwej geometrii oraz wygodne siodełko. Istotną rolę w przypadku tego rodzaju rowerów odgrywają również takie akcesoria jak błotniki, bagażnik (lub sakwy), czy też lampki na dynamo. Wszystko to razem powoduje, że jazda rowerem trekkingowym jest bezpieczna oraz komfortowa również podczas gorszej pogody bądź po zmroku. Rowery trekkingowe oferujemy w sprzedaży internetowej oraz bezpośredniej. Zapraszamy do naszego sklepu stacjonarnego – Poznań, ul. Mostowa 39.'),
(13, 'Rowery szosowe', 'Przystępne cenowo rowery szosowe. Rowery szosowe są dedykowane wszystkim tym osobom, które chcą szybko pokonywać duże dystanse w krótkim czasie. Ich charakterystyczną cechą jest kierownica zgięta w dół, która umożliwia przyjęcie jeszcze bardziej aerodynamicznej pozycji. Ten typ rowerów świetnie sprawdzi się głównie do jazdy po drogach utwardzonych (asfaltowych). Osobom, które są zainteresowane kupnem tego rodzaju modelów, polecamy zapoznanie się z działem wyprzedaż, w którym można znaleźć szosówki w wyjątkowo niskich cenach.'),
(14, 'Rowery dziecięce', 'Rowery dziecięce – dla małych cyklistów. Znajdujące się w asortymencie naszego sklepu rowery dziecięce pochodzą od cenionych na rynku producentów, którzy zadbali o to, by sprzęt dla małych cyklistów odznaczał się bezpieczeństwem oraz konstrukcją dostosowaną do anatomii kilkulatków. Proponowane przez nas rowery dla dzieci zapewniają wysoki komfort jazdy, przykuwając uwagę ciekawą, kolorową stylistyką. Maluchy swoją przygodę z jazdą na rowerze mogą rozpocząć z modelami takich firm, jak Kross czy Grand.'),
(15, 'Rowery crossowe', 'Główną zaletą rowerów crossowych jest ich bardzo duża uniwersalność. Rowery te gwarantują niskie opory toczenia na utwardzonych drogach oraz stosunkowo dobrze poczynają sobie w nietrudnym terenie. Radzą sobie na szerokim spektrum ścieżek, wyłączając tylko trudne technicznie trasy oraz silnie piaszczyste drogi. Pozycja zajmowana przez rowerzystę jest pewnym kompromisem między wydajnością i wygodą. Rowery crossowe mogą być łatwo wyposażone w dodatkowy osprzęt taki jak błotniki, bagażnik czy oświetlenie i stać się dogodnym środkiem komunikacji, choćby do dojazdów do pracy czy szkoły w mieście. Dobrze sprawdzają się także w turystyce rowerowej. Jeżeli będzie to Twój jedyny rower - prawdopodobnie crossówka będzie bardzo dobrym wyborem.'),
(16, 'Części rowerowe', 'Części rowerowe to elementy, które w dużym stopniu decydują o zwrotności, dynamice, a także o komforcie prowadzenia roweru. By mieć pewność, że nasz rower będzie sprzyjał bezpiecznej jeździe nawet na długie dystanse, warto sięgnąć po części do rowerów pochodzące od sprawdzonych producentów, takich jak Shimano, Kross, De One czy Neco. Dobre jakościowo hamulce, przerzutki, obręcze czy zębatki to doskonały wybór do rowerów trekkingowych, crossowych, górskich oraz miejskich.'),
(17, 'Odzież i rękawiczki', 'Podstawowy ubiór każdego rowerzysty'),
(18, 'Akcesoria rowerowe', 'Niezależnie od tego, czy rower wykorzystuje się w celach rekreacyjnych, sportowych, czy też jako środek do codziennego transportu, niezwykle istotne jest, aby posiadać do niego odpowiednie akcesoria. Tylko właściwie dobrane oraz solidne akcesoria rowerowe pozwolą bowiem w bezpieczny oraz komfortowy sposób przemierzać każdego rodzaju trasę. W obecnych czasach, producenci z branży rowerowej oferują tak ogromny repertuar produktów, że nie jeden pasjonat jednośladów może mieć trudności z ich optymalnym wyborem. Dlatego też, gdy zamierza się zakupić akcesoria do roweru, warto zdać się na pomoc ekspertów, którzy doradzą oraz podpowiedzą najlepsze rozwiązania, dopasowane do indywidualnych oczekiwań oraz predyspozycji finansowych danej osoby. O szerokim wyborze dostępnych współcześnie akcesoriów do rowerów, jak również o wartości profesjonalnej pomocy przy ich wyborze, przekonali się z pewnością wszyscy Klienci naszego sklepu. Zarówno w sprzedaży internetowej, jak również w naszej siedzibie w Poznaniu, udostępniamy niezwykle duży wybór różnego rodzaju artykułów rowerowych. Znajdują się tam akcesoria wpływające na bezpieczeństwo jazdy, poprawiające jej komfort czy czyniące podróżowanie rowerem jeszcze bardziej atrakcyjnym. Klientom oferujemy między innymi profesjonalne oświetlenie, foteliki dziecięce bądź też dzwonki. Osoby pragnące poprawić wygodę jazdy, zaopatrzyć się mogą w specjalne siodełka, koszyki lub sakwy. Natomiast takie akcesoria do roweru, jak nowoczesne liczniki dadzą możliwość lepszego kontrolowania tras przemierzanych rowerem. Tym co doceniają nasi Klienci jest jednakże nie tylko szeroki asortyment, jaki przedstawiamy. Każdy specjalista z teamu Bikefun zaoferować może bowiem profesjonalne wsparcie przy zakupie akcesoriów, które zostaną dobrane idealnie do wymagań konkretnego Klienta');

--
-- Zrzut danych tabeli `contact`
--

INSERT INTO `contact` (`id_contact`, `number_telephone`, `fax`, `email`, `site`) VALUES
(38, '+48 232 122 221', '', 'wti@wti.pl', 'http://www.wp.pl');

--
-- Zrzut danych tabeli `client`
--

INSERT INTO `client` (`id_client`, `id_adress`, `id_contact`, `user_login`, `md5_pass`, `name`, `nip`, `client_type`, `data_rejestracji`, `surname`, `privileges`, `date_last_logged`) VALUES
(17, 41, 38, 'krzysiek1994', '1104664a4ca7228f15510279577393ef', 'Jerzyński', '', 'standard', '2016-04-18 13:14:59', 'Krzysztof', 1, '2016-04-18');
--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id_order`, `id_client`, `is_accepted`, `is_paid`, `date_order`, `date_shipment`, `is_realized`, `date_realized_order`, `time_order`) VALUES
(20, 17, 0, 0, NULL, NULL, 0, NULL, NULL);

--
-- Zrzut danych tabeli `producer`
--

INSERT INTO `producer` (`id_producer`, `name`, `regon`, `nip`, `telephone`) VALUES
(14, 'Kross', '2483587357', '29489252', '+48 726 761 841'),
(15, 'Kross', '2483587357', '29489252', '+48 726 761 841'),
(16, 'De One', '2483587357', '29489252', '+48 726 761 841'),
(17, 'Continental', '2483587357', '29489252', '+48 726 761 841'),
(18, 'Bosh', '2483587357', '29489252', '+48 726 761 841'),
(19, 'The Best', '2483587357', '29489252', '+48 726 761 841'),
(20, 'Americano', '2483587357', '29489252', '+48 726 761 841'),
(21, 'Corratec', '934123434', '87494999', '+48 943 123 551'),
(22, 'Unibike', '219423351', '261371542', '+48 175 135 129'),
(23, 'Grand', '246161461', '951363124', '+48 295 129 123'),
(24, 'Shimano', '268234123', '171236123', '+48 168 126 883'),
(25, 'Neco', '342442092', '184112331', '+48 822 851 812'),
(26, 'CTS', '112334554', '812128231', '+48 881 841 932');

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `id_producer`, `name_product`, `descriptions`, `photography`, `price_netto`, `price_brutto`, `percent_vat`, `discount`, `amount`, `date_add_products`) VALUES
(6, 18, 20, 'Pedały Shimano SPD M520', '\r\n    Oś ze stali Cr-mo<br />\r\n    Zintegrowane odblaski<br />\r\n    Korpus z tworzywa sztucznego<br />\r\n', 'img/pedaly-shimano-spd-m520.jpg', '14.00', '17.08', '22.00', '0.00', 10, '2016-02-15'),
(7, 11, 16, 'Pompka Kross Tornado', 'Materiał: aluminium 6063 <br />\r\nZawór: F/V, A/V, D/V (przez przełożenie uszczelki)<br />\r\nCiśnienie: 160 psi<br />\r\nInformacje dodatkowe: wysoko umiejscowiony manometr, dźwignia blokująca, ergonomiczna rączka<br />\r\nWaga: 880 g<br />\r\nDługość: 61 cm<br />\r\nKolor: srebrny<br />', 'img/pompka-kross-tornado.jpg', '99.00', '120.78', '22.00', '5.00', 20, '2016-03-01'),
(8, 15, 25, 'Kross Moon 3.0 2016', 'Rama 	Aluminium Super Lite <br />\r\nWidelec 	RockShox Recon Silver Solo Air (skok 130mm, stożkowa rura sterowa główka, QR15)<br />\r\nTylny amortyzator 	-<br />\r\nIlość biegów 	27<br />\r\nPrzerzutka przód 	Shimano Acera FD-M3000<br />\r\nPrzerzutka tył 	Shimano Alivio RD-M4000<br />\r\nHamulec przód 	Avid DB1 (hydrauliczny, tarcza 180mm)<br />\r\nHamulec tył 	Avid DB1 (hydrauliczny, tarcza 180mm)<br />\r\nDźwignie hamulca 	Avid DB1<br />\r\nManetki 	Shimano Altus SL-M370, 9 biegów<br />\r\nKorby 	Suntour XCM410 40/30/22T<br />\r\nŁańcuch 	Shimano CN-HG53<br />\r\nKaseta / Wolnobieg 	Shimano Alivio CS-HG300-9 12-36T<br />\r\nPiasta przód 	Shimano Deore HB-M618 15x100mm<br />\r\nPiasta tył 	Shimano Deore FH-M618 12x142mm<br />\r\nOpony 	Shwalbe Nobby Nic Performance 27,5"x2,25<br />\r\nObręcze 	WTB STP i23 27,5" Tubeless Ready<br />\r\nKierownica 	Kross Racing Components (Aluminium, niski wznios 760mm 35mm)<br />\r\nWspornik kierownicy 	Kross Racing Components (Aluminium, ahead, 35mm)<br />\r\nWspornik siodła 	Kross Racing Components (Aluminium, 30,9mm)<br />\r\nStery 	VP A45AC3 pół- zintegrowane<br />\r\nSiodło 	Kross VL-1489<br />\r\nChwyty 	Kross<br />\r\nPedały 	-<br />\r\nWaga 	13.6<br />\r\nUwagi 	-<br />', 'img/kross-moon-30.jpg', '14500.00', '17690.00', '22.00', '0.00', 20, '2016-04-11');

--
-- Zrzut danych tabeli `tag`
--

INSERT INTO `tag` (`id_tag`, `name_tag`) VALUES
(1, '2016'),
(2, 'aluminium'),
(3, 'Continental'),
(4, 'kross'),
(5, 'Moon 3.0'),
(6, 'najlepsze_rowery'),
(7, 'okazja'),
(8, 'peda?y'),
(9, 'pompka'),
(10, 'rower'),
(11, 'Shimano'),
(12, 'SPD M520'),
(13, 'Tornado');

--
-- Zrzut danych tabeli `products_has_tag`
--

INSERT INTO `products_has_tag` (`id_product`, `id_tag`) VALUES
(6, 3),
(6, 7),
(6, 8),
(6, 11),
(7, 1),
(7, 9),
(7, 10),
(7, 11),
(8, 1),
(8, 2),
(8, 4),
(8, 12),
(8, 13);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
