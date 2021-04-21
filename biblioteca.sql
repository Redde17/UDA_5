-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 20, 2021 alle 18:29
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `appartiene`
--

CREATE TABLE `appartiene` (
  `Nome_Categoria` varchar(255) NOT NULL,
  `ID_Libro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `appartiene`
--

INSERT INTO `appartiene` (`Nome_Categoria`, `ID_Libro`) VALUES
('Fantascienza', 1),
('Romanzo', 2),
('Romanzo', 3),
('Romanzo', 4),
('Romanzo', 5),
('Romanzo', 6),
('Drammatico', 7),
('Poema', 7),
('Romanzo', 8),
('Romanzo', 9),
('Romanzo', 10),
('Romanzo', 11),
('Romanzo', 12),
('Poema', 13),
('Romanzo', 14),
('Poema', 15),
('Romanzo', 16),
('Romanzo', 17),
('Romanzo', 18),
('Modernismo', 19),
('Informatica', 20),
('Romanzo', 21),
('Avventura', 22),
('Azione', 22),
('Tecnica', 23),
('Informatica', 24),
('Tecnica', 25),
('Tecnica', 26),
('Avventura', 27),
('Azione', 27),
('Fantascienza', 27),
('Narrativa', 28),
('Poesia', 29),
('Tecnica', 30),
('Tecnica', 31),
('Informatica', 32),
('Romanzo', 33),
('Romanzo', 34),
('Avventura', 35),
('Romanzo', 35),
('Narrativa', 36),
('Romanzo', 36),
('Romanzo', 37),
('Romanzo', 38),
('Informatica', 39),
('Giallo', 40),
('Romanzo', 40),
('Avventura', 41),
('Fantascienza', 41),
('Romanzo', 42),
('Informatica', 43),
('Narrativa', 44),
('Avventura', 45),
('Fantascienza', 45),
('Sovrannaturale', 45),
('Avventura', 46),
('Romanzo', 46),
('Avventura', 47),
('Azione', 47),
('Giallo', 48),
('Romanzo', 49),
('Avventura', 50),
('Fantascienza', 50),
('Sovrannaturale', 50),
('Informatica', 51),
('Tecnica', 52),
('Biografia', 53),
('Tecnica', 54),
('Tecnica', 55),
('Avventura', 56),
('Azione', 57),
('Tecnica', 57),
('Tecnica', 58),
('Avventura', 59),
('Romantico', 59),
('Sovrannaturale', 59),
('Narrativa', 60),
('Avventura', 61);

-- --------------------------------------------------------

--
-- Struttura della tabella `autore`
--

CREATE TABLE `autore` (
  `ID` int(11) NOT NULL,
  `Cognome` varchar(255) DEFAULT NULL,
  `Nome` varchar(255) DEFAULT NULL,
  `Data_Nascita` date DEFAULT NULL,
  `Luogo_Nascita` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `autore`
--

INSERT INTO `autore` (`ID`, `Cognome`, `Nome`, `Data_Nascita`, `Luogo_Nascita`) VALUES
(1, 'Orwell', 'George', '1903-06-25', 'Motihari'),
(2, 'Capote', 'Truman', '1924-09-30', 'New Orleans'),
(3, 'García Márquez', 'Gabriel', '1927-03-06', 'Aracataca'),
(4, 'Dostoevskij', 'Fëdor', '1821-11-11', 'Moscow'),
(5, 'De Cervantes Saavedra', 'Miguel', '1547-09-29', 'Alcalá de Henares'),
(6, 'Stoker', 'Bram', '1847-11-08', 'Clontarf'),
(7, 'Wolfgang von Goethe', 'Johann', '1749-08-28', 'Frankfurt'),
(8, 'Dickens', 'Charles', '1812-02-07', 'Portsmouth'),
(9, 'Tolstoj', 'Lev', '1828-09-09', 'Yasnaya Polyana'),
(10, 'Dumas', 'Alexandre', '1802-07-24', 'Villers-Cotterêts'),
(11, NULL, 'Stendhal', '1783-01-23', 'Grenoble'),
(12, 'Svevo', 'Italo', '1861-12-19', 'Trieste'),
(13, 'Alighieri', 'Dante', '0000-00-00', 'Firenze'),
(14, 'Kundera', 'Milan', '1929-04-01', 'Brno'),
(15, NULL, 'Omero', NULL, 'Ionia'),
(16, 'Austen', 'Jane', '1775-12-16', 'Steventon'),
(17, 'Collodi', 'Carlo', '1826-11-24', 'Firenze'),
(18, 'Hesse', 'Hermann', '1877-07-02', 'Calw'),
(19, 'Proust', 'Marcel', '1871-07-10', 'Parigi'),
(20, 'Atzeni', 'Paolo', NULL, NULL),
(21, 'Bronte', 'Emily', '1818-07-30', 'Thornton'),
(22, 'Bowden', 'Oliver', '1948-10-22', 'Ilford'),
(23, 'Perfetti', 'Renzo', NULL, NULL),
(24, 'Horstmann', 'Cay', '1959-06-16', NULL),
(25, 'Di Leo', 'Paolo', NULL, NULL),
(26, 'Bossi', 'Antonio', NULL, NULL),
(27, 'Christopher', 'Paolini', '1983-11-17', 'Los Angeles'),
(28, 'Luis Borges', 'Jorge', '1899-08-24', 'Buenos Aires'),
(29, 'Whitman', 'Walter', '1819-05-31', 'West Hills'),
(30, 'Ferrari', 'Francesco', NULL, NULL),
(31, 'Tommasini', 'Danilo', NULL, NULL),
(32, 'Brookshear', 'J.Glenn', NULL, NULL),
(33, 'Manzoni', 'Alessandro', '1785-03-07', 'Milano'),
(34, 'Calvino', 'Italo', '1923-10-15', 'Havana'),
(35, 'Buzzati', 'Dino', '1906-10-16', 'Belluno'),
(36, 'Pirandello', 'Luigi', '1867-06-28', 'Agrigento'),
(37, 'Di Lampedusa', 'Giuseppe Tomasi', '0000-00-00', 'Palermo'),
(38, 'J. Deitel', 'Paul', NULL, NULL),
(39, 'Eco', 'Umberto', '1932-01-05', 'Alessandria'),
(40, 'R.R.Tolkien', 'John', '1892-01-03', 'Bloemfontein'),
(41, 'Hemingway', 'Ernest', '1899-07-21', 'Illinois'),
(42, 'Mezzini', 'Mauro', NULL, NULL),
(43, 'Pavese', 'Cesare', '1908-09-09', 'Santo Stefano Belbo'),
(44, 'Troisi', 'Licia', '1980-11-25', 'Ostia'),
(45, 'Louis Stevenson', 'Robert', '1850-11-13', 'Edinburgo'),
(46, 'Dashner', 'James', '1972-11-26', 'Austell'),
(47, 'Lucarelli', 'Carlo', '1960-10-26', 'Parma'),
(48, 'Ariosto', 'Ludovico', '1474-09-08', 'Reggio Emilia'),
(49, 'Castagna', 'Manlio', '0000-00-00', 'Salerno'),
(50, 'Di Bello', 'Bonavventura', NULL, NULL),
(51, 'Pattavina', 'Achille', NULL, NULL),
(52, 'Levi', 'Primo', '1919-07-31', 'Torino'),
(53, 'Filella', 'Giampiero', NULL, NULL),
(54, 'Lo Russo', 'Luigi', NULL, NULL),
(55, 'Clancy', 'Tom', '1947-04-12', 'Maryland'),
(56, 'R. Schmid', 'Steven', NULL, NULL),
(57, 'Ambrosini', 'Enrico', NULL, NULL),
(58, 'Meyer', 'Stephenie', '1973-12-24', 'Connecticut'),
(59, 'Joyce', 'James', '1882-02-02', 'Rathgar'),
(60, 'London', 'Jack', '1876-01-12', 'San Francisco');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `Nome` varchar(255) NOT NULL,
  `Descrizione` varchar(255) DEFAULT NULL,
  `Colore` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`Nome`, `Descrizione`, `Colore`) VALUES
('Avventura', NULL, NULL),
('Azione', NULL, NULL),
('Biografia', NULL, NULL),
('Drammatico', NULL, NULL),
('Fantascienza', NULL, NULL),
('Fantasy', NULL, NULL),
('Giallo', NULL, NULL),
('Informatica', NULL, NULL),
('Modernismo', NULL, NULL),
('Narrativa', NULL, NULL),
('Poema', NULL, NULL),
('Poesia', NULL, NULL),
('Romantico', NULL, NULL),
('Romanzo', NULL, NULL),
('Sovrannaturale', NULL, NULL),
('Tecnica', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `editore`
--

CREATE TABLE `editore` (
  `Codice` int(11) NOT NULL,
  `Nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `editore`
--

INSERT INTO `editore` (`Codice`, `Nome`) VALUES
(1, 'HarperCollins Publishers'),
(2, 'Garzanti Libri'),
(3, 'Famiglia cristiana'),
(4, 'Dalai'),
(5, 'La spiga'),
(6, 'Oxford University Press'),
(7, 'Mondadori'),
(8, 'Rizzoli'),
(9, 'Einaudi'),
(10, 'Signum'),
(11, 'Eulenspiegel'),
(12, 'Newton'),
(13, 'Feltrinelli'),
(15, 'Casa del Libro'),
(16, 'McGraw-Hill Education'),
(17, 'Pickwick'),
(18, 'Zanichelli'),
(19, 'Dover Publications'),
(20, 'Sandit Libri'),
(21, 'Editoriale Delfino'),
(22, 'Pearson'),
(23, 'BUR'),
(24, 'Rusconi Libri'),
(25, 'Moscabianca'),
(26, 'RCS Mediagroup'),
(27, 'Bompiani'),
(28, 'Hoepli'),
(29, 'Maggioli'),
(30, 'Newton Compton Editori'),
(31, 'Fanucci'),
(33, 'Sendit libri'),
(34, 'Tramontana'),
(35, 'Tascabili'),
(36, 'Giulio De Angelis'),
(37, 'Crescere');

-- --------------------------------------------------------

--
-- Struttura della tabella `libro`
--

CREATE TABLE `libro` (
  `ID` int(11) NOT NULL,
  `Titolo` varchar(255) DEFAULT NULL,
  `Codice_Editore` int(11) DEFAULT NULL,
  `Descrizione` varchar(5000) DEFAULT NULL,
  `Numero_Copie` int(11) DEFAULT NULL,
  `Immagine` varchar(255) DEFAULT NULL,
  `ID_Autore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `libro`
--

INSERT INTO `libro` (`ID`, `Titolo`, `Codice_Editore`, `Descrizione`, `Numero_Copie`, `Immagine`, `ID_Autore`) VALUES
(1, '1984', 1, 'La specificità del romanzo 1984 (Nineteen Eighty-Four): Nella comprensione profonda delle possibilità di manipolazione psicologica dello stato totalitario, va individuata la vera specificità di 1984, il romanzo più famoso di Orwell. Nell\'incubo fantascientifico lì descritto, l\'autorità dell\'Oceania è programmaticamente orientata ad imporre un linguaggio inadatto all\'espressione delle potenzialità critiche del pensiero. Cerca quindi di abituare le menti umane alla tolleranza (diciamo sudditanza) per le contraddizioni logiche che caratterizzano la propaganda politica del Grande Fratello, e cerca di canalizzare l\'emotività individuale nelle sole direzioni utilizzabili per la riproduzione dell\'ordine sociale. Orwell ha presentato in modo così accurato processi mentali (bipensiero) e strutture linguistiche (neolingua) funzionali all\'irrazionalismo sociale totalitario, che 1984 è diventato una citazione d\'obbligo nei manuali di psicologia sociale e negli studi sulla comunicazione interpersonale.', NULL, '91SZSW8qSsL.jpg', 1),
(2, 'A sangue freddo', 2, 'A sangue freddo (In Cold Blood) è un romanzo dello scrittore statunitense Truman Capote, pubblicato in volume nel 1966 presso Random House, dopo esser uscito a puntate sul New Yorker tra settembre e ottobre 1965. È il resoconto dettagliato del quadruplice omicidio della famiglia Clutter, ma anche un\'impietosa radiografia del sogno americano vissuto in provincia. Per la sua costruzione narrativa Capote si pose come obiettivo esplicito di raccontare i fatti effettivamente avvenuti ma adottando i moduli narrativi tipici del romanzo di finzione, coniando l\'espressione di non-fiction novel, un genere del quale egli è considerato il fondatore nella narrativa USA', NULL, '81IqsAxscVL.jpg', 2),
(3, 'Cent\'anni di solitudine', 3, 'Narra le vicende di sette generazioni della famiglia Buendía, il cui capostipite, José Arcadio, fonda alla fine del XIX secolo la città di Macondo. La storia è narrata con uno stile elaborato e personale, ricco di prolessi che anticipano drammaticamente gli avvenimenti ancora da narrare. Attraverso un modello che unisce rigore formale e frasi sontuose, radici classiche e sperimentazione, il romanzo svelò il vitalismo di un universo di solitudini incrociate, dove si succedono i destini ineluttabili di una famiglia, romanzo nel quale, come disse Ariel Dorfman, «l\'individuo è divorato dalla storia e la storia è divorata a sua volta dal mito»', NULL, '978880467598HIG.jpg', 3),
(4, 'Delitto e castigo', 4, 'Insieme a Guerra e pace di Lev Tolstoj, fa parte dei romanzi russi più famosi e influenti di tutti i tempi. Esso esprime i punti di vista religiosi ed esistenzialisti di Dostoevskij, con una focalizzazione predominante sul tema del conseguimento della salvezza attraverso la sofferenza.', NULL, '912XgcSooFL.jpg', 4),
(5, 'Don Chisciotte della Mancia', 5, 'L\'opera di Cervantes fu pubblicata nel 1605 quando l\'autore aveva 57 anni. Il successo fu tale che Alonso Fernández de Avellaneda, pseudonimo di un autore fino ad oggi sconosciuto, pubblicò la continuazione nel 1614. Cervantes, disgustato da questo sequel, decise di scrivere un\'altra avventura del Don Quijote - la seconda parte - pubblicata nel 1615. Con oltre 500 milioni di copie, è il romanzo più venduto della storia.', NULL, 'don-chisciotte-della-mancia-22.jpg', 5),
(6, 'Dracula', 6, 'Dracula è un romanzo scritto da Bram Stoker nel 1897, che ha dato origine al personaggio del Conte Dracula, quest\'ultimo ispirato alla figura storica di Vlad III di Valacchia.', NULL, '81K6RzMAF2L.jpg', 6),
(7, 'Faust', 7, 'Faust è un dramma in versi di Johann Wolfgang von Goethe. Scritto nel 1808, è l\'opera più famosa di Goethe e una delle più importanti della letteratura europea e mondiale. Si ispira alla tradizionale figura del Dottor Faust della tradizione letteraria europea. Il poema racconta il patto tra Faust e Mefistofele e il loro viaggio alla scoperta dei piaceri e delle bellezze del mondo.', NULL, '91SQ7W9bxoL.jpg', 7),
(8, 'Grandi Speranze', 8, 'Grandi speranze (titolo originale Great Expectations) è il tredicesimo romanzo di Charles Dickens. Fu scritto e pubblicato a puntate tra il 1860 e il 1861. È il secondo romanzo di Dickens, dopo David Copperfield, ad essere stato scritto interamente in prima persona.', NULL, '9788893810128_92_1000_0_75.jpg', 8),
(9, 'Guerra e Pace', 9, 'Scritto tra il 1863 e il 1869 e pubblicato per la prima volta tra il 1865 e il 1869 sulla rivista Russkij Vestnik, riguarda principalmente la storia di due famiglie, i Bolkonskij e i Rostov, tra le guerre napoleoniche, la campagna napoleonica in Russia del 1812 e la fondazione delle prime società segrete russe. Tolstoj paragonava la sua opera alle grandi creazioni omeriche, e nella sua immensità Guerra e pace si potrebbe dire un romanzo infinito, nel senso che l\'autore sembra essere riuscito a trovare la forma perfetta con cui descrivere in letteratura l\'uomo nel tempo. Denso di riferimenti filosofici, scientifici e storici, il racconto sembra unire la forza della storicità e la precisione drammaturgica (persino di Napoleone si fa un ritratto indimenticabile) ad un potente e lucido sguardo metafisico che domina il grande flusso degli eventi, da quelli colossali, come la battaglia di Austerlitz e la battaglia di Borodino, a quelli più intimi.', NULL, '81HBOyVy6SL.jpg', 9),
(10, 'Il Conte di Montecristo', 10, 'La storia è ambientata tra l\'Italia, la Francia e alcune isole del Mar Mediterraneo, durante gli anni tra il 1815 ed il 1838 (dall\'esordio del regno di Luigi XVIII di Borbone al regno di Luigi Filippo d\'Orléans). Romanzo dalla forte valenza emotiva, oltre che affresco della storia francese ed europea del XIX secolo, negli ultimi 170 anni non ha mai smesso di appassionare e avvincere i lettori.', NULL, '71hm8LG9flL.jpg', 10),
(11, 'Il rosso e il nero', 13, 'Il rosso e il nero (titolo originale, Le Rouge et le Noir, con due sottotitoli: Chronique du XIXe siècle e Chronique de 1830) è un romanzo dello scrittore francese Stendhal.Il manoscritto fu venduto per 1500 franchi all\'editore Levasseur che lo pubblicò in due tomi a Parigi nel novembre del 1830 con data 1831.La storia viene ripresa da Stendhal da un fatto di cronaca. L\'autore infatti aveva letto di un giovane che uccise l\'ex amante sulla rivista La Gazette des Tribunaux', NULL, 'EC10841_HR.jpg', 11),
(12, 'La coscienza di Zeno', 7, 'Il romanzo non è altro che l\'analisi della psiche di Zeno, un individuo che si sente malato e inetto ed è continuamente in cerca di una guarigione dal suo malessere attraverso molteplici tentativi, a volte assurdi o che portano a effetti controproducenti.', NULL, 'La_coscienza_di_Zeno.jpg', 12),
(13, 'La Divina Commedia', 15, 'La Comedìa, o Commedia, conosciuta soprattutto come Divina Commedia, è un poema allegorico-didascalico di Dante Alighieri, scritto in terzine incatenate di endecasillabi (poi chiamate per antonomasia terzine dantesche) in lingua volgare fiorentina.', NULL, 'la-divina-commedia-di-dante-4.jpg', 13),
(14, 'L\'insostenibile leggerezza dell\'essere', 13, 'L\'insostenibile leggerezza dell\'essere (Nesnesitelná lehkost bytí) è un romanzo di Milan Kundera scritto nel 1982 e pubblicato per la prima volta in Francia nel 1984.', NULL, '101614.jpg', 14),
(15, 'Odissea', 13, 'L\'Odissea (in greco antico: Ὀδύσσεια, Odýsseia) è uno dei due grandi poemi epici greci attribuiti al poeta Omero. Narra delle vicende riguardanti l\'eroe Odisseo (o Ulisse, con il nome latino), dopo la fine della Guerra di Troia, narrata nell\'Iliade. Assieme a quest\'ultima, rappresenta uno dei testi fondamentali della cultura classica occidentale e viene tuttora comunemente letto in tutto il mondo sia nella versione originale che nelle sue numerose traduzioni.', NULL, 'Odissea-La-Nuova-Frontiera-Junior.jpg', 15),
(16, 'Orgoglio e Pregiudizio', 7, 'Orgoglio e pregiudizio (Pride and Prejudice) è uno dei più celebri romanzi della scrittrice inglese Jane Austen, pubblicato il 28 gennaio 1813', NULL, 'Orgoglio_e_pregiudizio.jpg', 16),
(17, 'Pinocchio', 19, 'Le avventure di Pinocchio. Storia di un burattino è un romanzo per ragazzi scritto da Carlo Collodi, pseudonimo del giornalista e scrittore fiorentino Carlo Lorenzini. La prima metà apparve originariamente a puntate tra il 1881 e il 1882, pubblicata come La storia di un burattino, poi completata nel libro per ragazzi uscito a Firenze nel febbraio 1883.', NULL, '710Ggr-SJbL.jpg', 17),
(18, 'Siddhartha', 19, 'Considerato dallo stesso Hesse come un poema indiano, il romanzo presenta un registro molto originale che unisce lirica ed epica, ma anche narrazione e meditazione, elevazione e sensualità. Il romanzo è ispirato liberamente alla vicenda biografica del Buddha, Siddhartha Gautama, anche se il Siddharta protagonista non è il Buddha storico, il quale compare nel libro come personaggio secondario sotto il nome di Gotama, ma un personaggio di fantasia che rappresenta «uno dei tanti Buddha potenziali».', NULL, 'siddhartha-215.jpg', 18),
(19, 'Alla Ricerca del Tempo Perduto', 7, 'Alla ricerca del tempo perduto è l\'opera più famosa di Marcel Proust; composta da sette romanzi, è una cronaca basata sui ricordi di Marcel, il narratore protagonista, che si rincorrono l\'un l\'altro non in ordine cronologico, ma seguendo i moti dell\'anima. Un viaggio che è appunto una ricerca, innanzitutto, come il titolo suggerisce, del tempo che è passato inteso come momento in cui si può trovare davvero se stessi, come momento in cui compiere un’introspezione personale, velata di sofferenza.', NULL, 'Alla_ricerca_del_tempo_perduto.png', 19),
(20, 'Basi di dati. Modelli e linguaggi di interrogazione', 16, 'Questo volume si rivolge agli studenti dei corsi di Basi di dati dei corsi di laurea in Ingegneria, Scienze dell\'Informazione, Informatica. Il testo si articola in tre parti. La prima illustra le caratteristiche fondamentali delle basi di dati, (modello relazionale e relativi linguaggi). Nella seconda viene trattato il processo di progettazione concettuale, logica e fisica e, conseguentemente, le tecniche principali per l\'utilizzo nelle applicazioni. Nell\'ultima vengono descritte le caratteristiche hardware e software del sistema informativo.', NULL, 'Basi_di_dati_Modelli_e_linguaggi_di_interrogazione.png', 20),
(21, 'Cime Tempestose', 13, 'Cime tempestose è un romanzo selvaggio, originale, possente, si leggeva in una recensione della «North American Review», apparsa nel dicembre del 1848, e se la riuscita di un romanzo dovesse essere misurata unicamente sulla sua capacità evocativa, allora «Wuthering Heights» può essere considerata una delle migliori opere mai scritte in inglese.', NULL, 'Cime_tempestose.png', 21),
(22, 'Assassin\'s creed Rinascimento', 17, 'Firenze, 1476. Ezio Auditore ha diciassette anni, è figlio di un ricco banchiere alleato dei Medici, e trascorre molto del suo tempo assieme agli amici, tra divertimenti e bravate. Non ha un problema al mondo, e si gode la vita. Ma quella giovinezza spensierata termina bruscamente quando la sua famiglia viene ingiustamente accusata di aver cospirato ai danni del governo. Suo padre e i suoi fratelli vengono giustiziati dopo che Uberto Alberti, un magistrato corrotto alleato dei Pazzi, distrugge le prove che inchiodano i veri responsabili. Solo Ezio, miracolosamente, riesce a sfuggire alla cattura. All\'improvviso, è costretto a diventare adulto: deve nascondersi, difendersi, proteggere la sorella e la madre. Ma vuole vendetta.', NULL, 'Assassins_creed_rinascimento.jpg', 22),
(23, 'Circuiti Elettrici', 18, 'La seconda edizione di Circuiti elettrici mantiene la collaudata impostazione basata su una graduale esposizione della teoria, con particolare attenzione alle tecniche di risoluzione dei problemi, descritte in forma algoritmica e illustrate attraverso numerosi esempi svolti. Alcuni argomenti sono presentati secondo un nuovo ordine, più funzionale alle esigenze didattiche. Molti esempi sono stati aggiornati.', NULL, 'Circuiti_elettrici.png', 23),
(24, 'Concetti di informatica e fondamenti di Python', 29, 'Questo volume è dedicato a Python, un linguaggio di programmazione diffuso da anni tra i professionisti grazie alla sua potenza e semplicità sintattica, e di utilizzo sempre più frequente anche in ambito universitario.', NULL, 'Concetti_di_informatica_e_fondamenti_di_Python.png', 24),
(25, 'Elettronica digitale per tutti', 20, 'Questo libro permette avvicinarsi all’elettronica digitale senza entrare nel merito dell’algebra di Boole, la quale, a volte, è un ostacolo per i principianti e non strettamente necessaria per l’analisi di circuiti digitali. È stato preferito l’uso di “circuiti ragionati” o logici, coadiuvati da quelli di montaggio, i quali spiegati nelle loro singole funzioni, aiutano a comprendere quei “meccanismi” nascosti che a prima vista potrebbero apparire semplici.', NULL, 'Elettronica_digitale_per_tutti.png', 25),
(26, 'Elettrotecnica Pratica', 21, 'Il volume offre un quadro completo ed aggiornato delle leggi che regolano l\'elettrotecnica, leggi che anche un tecnico pratico,quale può essere un installatore,non può esimersi dal conoscere per svolgere razionalmente il proprio lavoro. Lo studio dell\'elettrotecnica diventa così interessante e consente al lettore di apprendere le leggi fondamentali sulle applicazioni e di avere una visione chiara e precisa dello stato attuale del progresso tecnico-scientifico.', NULL, 'Elettrotecnica_Pratica.png', 26),
(27, 'Eragon', 8, 'Quando Eragon trova una liscia pietra blu nella foresta, è convinto che gli sia toccata una grande fortuna: potrà venderla e nutrire la sua famiglia per tutto l\'inverno. Ma la pietra in realtà è un uovo. Quando si schiude rivelando il suo straordinario contenuto, un cucciolo di drago, Eragon scopre che gli è toccato in sorte un\'eredità antica come l\'Impero.', NULL, 'Eragon.jpg', 27),
(28, 'Finzioni', 9, 'L\'opera è divisa in due parti. Temi ricorrenti sono: l\'universo come serie di processi mentali o come biblioteca infinita; il destino dell\'uomo dominato dal caso; le qualità umane contrapposte a quelle divine. In tutti i racconti domina una problematica filosofica sottesa ad un intreccio narrativo complesso. La letteratura come \'finzione\', come riflesso e chiave di lettura del mondo.', NULL, 'Finzioni.png', 28),
(29, 'Foglie d\'erba', 13, 'Nel 1855 Walt Whitman, il grande poeta dell’anima americana, dava alla luce le prime Foglie d’erba, ovvero le prime poesie che comporranno la raccolta di una vita. I testi furono immediatamente amati dal grande Ralph Waldo Emerson, che li definì “l’esempio più straordinario di intelligenza e di saggezza che l’America abbia sin qui offerto”. Il grande edificio delle Foglie d’erba crescerà, una zolla dopo l’altra, una poesia dopo l’altra, un’edizione dopo l’altra, per tutta la vita di Whitman.', NULL, 'Foglie_d\'erba.jpg', 29),
(30, 'Fondamenti di elettronica', 18, 'Il libro  abbraccia tutti i contenuti di base per un corso di elettronica generale: La prima parte richiama concetti di base di analisi e modellizzazione dei circuiti, strumenti fondamentali per lo studio dei circuiti elettronici. ', NULL, 'Fondamenti_di_elettronica.png', 30),
(31, 'Fondamenti di elettrotecnica generale', 20, 'Questo libro, suddiviso in sette unità, propone, attraverso una didattica attenta agli stili cognitivi degli interessati, un percorso formativo che, senza tralasciare gli aspetti fondanti della disciplina, ne mette in luce i caratteri più innovativi e in linea con le esigenze del mondo del lavoro. La ricchezza di esercizi sottolineano la vocazione professionalizzante del volume, che tuttavia non trascurano l\'obiettivo di fornire una solida preparazione di base attraverso il raggiungimento di competenze prestabilite.', NULL, 'Fondamenti_di_elettrotecnica_generale.png', 31),
(32, 'Fondamenti di informatica e programmazione', 22, 'Il manuale fornisce un\'introduzione integrata e organica agli argomenti che costituiscono quei corsi universitari che affrontano cenni di fondamenti di informaticaunitamente alla programmazione.Lo scopo è sviluppare una conoscenza operativa dell\'informatica; l\'informatica, infatti, offre un fondamento scientifico ad argomenti come la progettazione di computer, la programmazione, l\'elaborazione delle informazioni, le soluzioni algoritmiche dei problemi e il processo algoritmico stesso.', NULL, 'Fondamenti_di_informatica_e_programmazione_in_c.png', 32),
(33, 'I promessi sposi', 7, 'I promessi sposi è un celebre romanzo storico di Alessandro Manzoni, ritenuto il più famoso e il più letto tra quelli scritti in lingua italiana. Preceduto dal Fermo e Lucia, spesso considerato romanzo a sé, fu pubblicato in una prima versione nel 1827 (detta ventisettana); rivisto in seguito dallo stesso autore, soprattutto nel linguaggio, fu ripubblicato nella versione definitiva fra il 1840 e il 1842 (detta quarantana).', NULL, 'I_Promessi_Sposi.png', 33),
(34, 'I tre moschettieri', 23, 'Athos, Porthos, Aramis, d\'Artagnan, il Cardinale Richelieu, la perfida Milady, la dolce signora Bonacieux, Luigi XIII, Anna d\'Austria, il duca di Buckingham, i moschettieri del re e le guardie del cardinale... Duelli, inseguimenti, amori, beffe, \'Tutti per uno, uno per tutti\'. Con questo romanzo Alexandre Dumas ha creato personaggi che resteranno vivi ancora a lungo.', NULL, 'I_tre_moschettieri.png', 10),
(35, 'Il barone rampante', 7, 'Il 15 giugno del 1767 il baroncino Cosimo Piovasco di Rondò decide di salire su un albero del suo giardino e da lì non scenderà per il resto della sua vita. Quello che all\'apparenza sembra un capriccio per evitare di mangiarsi un piatto di lumache preparato dalla sorella Battista si tramuta in un gesto ribelle che rivoluzionerà la sua intera esistenza. Né minacce di castighi né promesse di perdono gli faranno cambiare idea e tutti i suoi familiari dovranno alla fine rassegnarsi e accettare la sua scelta assurda quanto incomprensibile. Sugli alberi, Cosimo vivrà giorni liberi, all\'insegna dell\'avventura e dell\'intraprendenza, imparerà a badare a se stesso e ad amare e proteggere la natura che lo circonda, e non mancheranno certo amicizie stravaganti. Questa edizione, dedicata ai ragazzi e realizzata da Italo Calvino nel 1959, mantiene intatte la qualità della scrittura e la suggestione del racconto. ', NULL, 'Il_barone_rampante.png', 34),
(36, 'Il Deserto dei Tartari', 26, 'Il romanzo è ambientato in un paese immaginario. La trama segue la vita del sottotenente Giovanni Drogo dal momento in cui, divenuto ufficiale, viene assegnato come prima nomina alla Fortezza Bastiani, molto distante dalla città. La Fortezza, ultimo avamposto ai confini settentrionali del Regno,domina la desolata pianura chiamata \'deserto dei Tartari\', un tempo teatro di rovinose incursioni da parte dei nemici. Tuttavia, da innumerevoli anni nessuna minaccia è più apparsa su quel fronte; la Fortezza, svuotata ormai della sua importanza strategica, è rimasta solo una costruzione arroccata su una solitaria montagna, di cui molti ignorano persino l\'esistenza.', NULL, 'Il_deserto_dei_tartari.png', 35),
(37, 'Il fu Mattia Pascal', 7, 'Pubblicato per la prima volta nel 1904, \'Il fu Mattia Pascal\' inaugura la stagione dell\'umorismo pirandelliano. Il protagonista del romanzo, dopo essere stato dato per morto e aver trascorso una \'vita parallela\' torna al suo paese d\'origine con l\'intenzione di vendicarsi dei torti subiti; ma si ritrova invischiato in una situazione paradossale, da cui esce solo rinunciando allo status di essere vivente. In accesa polemica con le convenzioni razionalistiche e scientiste e i vincoli della società moderna, Luigi Pirandello, premio Nobel per la letteratura nel 1934, affida al suo romanzo più celebre il rifiuto delle convenzioni letterarie, recuperando invece la tradizione sterniana e senza dimenticare le esigenze della suspense. E di una delle opere più originali ed eccentriche di inizio Novecento Alberto Casadei propone una nuova edizione ampiamente commentata e aggiornata ai risultati della ricerca più recente.', NULL, 'Il_fu_mattia_pascal.png', 36),
(38, 'Il gattopardo', 13, 'Siamo in Sicilia, all\'epoca del tramonto borbonico: è di scena una famiglia della più alta aristocrazia isolana, colta nel momento rivelatore del trapasso di regime, mentre già incalzano i tempi nuovi (dall\'anno dell\'impresa dei Mille di Garibaldi la storia si prolunga fino ai primordi del Novecento). Accentrato quasi interamente intorno a un solo personaggio, il principe Fabrizio Salina, il romanzo, lirico e critico insieme, ben poco concede all\'intreccio e al romanzesco tanto cari alla narrativa dell\'Ottocento. L\'immagine della Sicilia che invece ci offre è un\'immagine viva, animata da uno spirito alacre e modernissimo, ampiamente consapevole della problematica storica e politica contemporanea.', NULL, 'Il_gattopardo.png', 37),
(39, 'Il linguaggio C. fondamenti e tecniche di programmazione', 22, 'Pearson Learning Solution nasce dall\'esperienza del principale editore educational nel mondo. Ogni progetto didattico Pearson è composto da un manuale di riferimento e da una serie di supporti digitali, piattaforme di e-learning, che accrescono la qualità dello studio, riducono i tempi di apprendimento e aiutano a misurare il livello di preparazione raggiunto tramite test ed esercizi di autovalutazione.', NULL, 'Il_linguaggio_C_fondamenti_e_tecniche_di_programmazione.png', 38),
(40, 'Il Nome Della Rosa', 27, 'Il protagonista e narratore de Il nome della rosa è Adso da Melk che racconta, ormai anziano,le misteriose vicende che ebbero luogo nel 1327 in un monastero benedettino mentre lui era ancora un novizio. In una delle ultime settimane del 1327 Adso, in compagnia del suo maestro Guglielmo da Baskerville trascorrono una settimana in un monastero benedettino in cui si verificano misteriosi omicidi.', NULL, 'Il_nome_della_rosa.jpg', 39),
(41, 'Il Signore degli anelli, la compagnia dell\'anello', 27, 'Il Signore degli Anelli è uno dei più grandi cicli narrativi del XX secolo. J.R.R. Tolkien, studioso di letteratura inglese medievale e anglosassone, è riuscito a creare un mondo e un epos che da sempre affascinano e influenzano lettori e scrittori di tutto il mondo. La Compagnia dell\'Anello si apre nella Contea, un idilliaco paese agricolodove vivono gli hobbit, piccoli esseri lieti, saggi e longevi. La quiete è turbata dall\'arrivo dello stregone Gandalf, che convince Frodo a partire per il paese delle tenebre, Mordor, dove dovrà gettare nelle fiamme del Monte Fato il terribile Anello del Potere, giunto nelle sue mani per una serie di incredibili circostanze. Un gruppo di altri hobbit lo accompagna e strada facendo si uniscono alla banda l\'elfo, il nano e alcuni uomini, tutti uniti nella lotta contro il Male. La Compagnia affronta un cammino lungo e pericoloso, finché i suoi membri si disperdono, minacciati da forze oscure, mentre la meta sembra allontanarsi sempre di più.', NULL, 'Il_signore_degli_anelli.jpg', 40),
(42, 'Il vecchio e il mare', 7, 'Dopo ottantaquattro giorni durante i quali non è riuscito a pescare nulla, il vecchio Santiago trova la forza di riprendere il mare: questa nuova battuta di pesca rinnova il suo apprendistato di pescatore e sigilla la sua simbolica iniziazione. Nella disperata caccia a un enorme pesce spada dei Caraibi. nella lotta quasi a mani nude contro gli squali che un pezzo alla volta gli strappano la preda, lasciandogli solo il simbolo della vittoria e della maledizione finalmente sconfitta. Santiago stabilisce, forse per la prima volta, una vera fratellanza con le forze incontenibili della natura. E, soprattutto, trova dentro di sé il segno e la presenza del proprio coraggio, la giustificazione di tutta una vita.', NULL, 'Il_vecchio_e_il_mare.png', 41),
(43, 'Informatica di base', 29, 'Questo libro si rivolge a chiunque voglia acquisire le nozioni di base relative all’informaticae alle tecnologie della comunicazione e dell’informazione. L’obiettivo è fornire al lettore un insieme di conoscenze e competenze per iniziare un utilizzo pieno e consapevole di tali tecnologie.', NULL, 'Informatica_di_base.png', 42),
(44, 'La luna e i falò', 30, 'La storia, raccontata in prima persona, non concerne solo il protagonista, di cui viene detto solo il soprannome Anguilla,ma tanti altri personaggi che entrano in relazione con lui, in un paese della valle del Belbo che non viene mai nominato, ma che è Santo Stefano Belbo (Piemonte).Il romanzo è un misto tra passato e presente e proprio per questo non è narrato nei minimi dettagli, ma vengono raccontati eventi che non sono (apparentemente) collegati tra loro, se non dai pensieri e dalle riflessioni del protagonista.', NULL, 'La_luna_e_i_falo.jpg', 43),
(45, 'La Ragazza Drago', 7, 'Sofia guarda Roma attraverso il cancello dell\'istituto dove è cresciuta e pensa che ormai non verrà più adottata da nessuno. Finché un eccentrico professore di antropologia non la prende con sé e la porta in una casa sul lago costruita intorno a un albero antico. Molto antico.Il professore sembra conoscere molte cose del passato di Sofia. Un passato lontano, oscuro e magico che le ha impresso sulla fronte un neo, il segno dell\'eredità dell\'ultimo dei draghi: Thuban, colui che ha sconfitto e imprigionato Nidhoggr, la feroce viverna alata, nelle viscere della Terra. Dopo trentamila anni la viverna si sta risvegliando, e tocca alla ragazza con il neo sulla fronte difendere la stirpe di drago.', NULL, 'La_ragazza_drago.png', 44),
(46, 'L\'isola del tesoro', 7, '\'Sali a bordo dell\'Hispaniola per cercare la X sulla mappa del tesoro. E... attenzione ai compagni di viaggio!\' Quando trova la mappa del tesoro del capitano Flint, il giovane Jim Hawkins si unisce alla spedizione finanziata dal conte Trelawney verso un\'isola sconosciuta. Ad accompagnarli il cuoco di bordo, di nome Long John Silver, con una gamba di legno e un pappagallo sempre sulla spalla. Ma qualcosa non quadra e presto Jim si accorge che tra l\'equipaggio si nascondono un\'intera ciurma di pirati e il suo terribile capitano. ', NULL, 'Isola_del_tesoro.png', 45),
(47, 'Maze runner: il labirinto', 31, 'Quando Thomas si risveglia, le porte dell’ascensore in cui si trova si aprono su un mondo che non conosce. Non ricorda come ci sia arrivato, né alcun particolare del suo passato, a eccezione del proprio nome. Con lui ci sono altri ragazzi, tutti nelle sue stesse condizioni, che gli danno il benvenuto nella Radura, un ampio spazio delimitato da invalicabili mura. L’unica certezza dei ragazzi è che ogni mattina le porte di pietra del gigantesco Labirinto che li circonda vengono aperte, per poi richiudersi di notte. Ben presto il gruppo elabora l’organizzazione di una società in cui vigono rigorose regole per mantenere l’ordine, e ogni trenta giorni qualcuno si aggiunge a loro dopo essersi risvegliato nell’ascensore. Il mistero si infittisce quando senza che nessuno se lo aspettasse arriva una ragazza che porta con sé un messaggio che non lascia alternative se non la fuga. Ma il Labirinto sembra essere inespugnabile... e potrebbe rivelarsi una trappola mortale.', NULL, 'Maze_runner_il_labirinto.png', 46),
(48, 'Misteri d\'italia, i casi di blu notte', 9, 'Dalla strage di Bologna a quella di Ustica, dall\'omicidio di Pier Paolo Pasolini a quelli di Alceste Campanile, di Beppe Alfano e di Wilma Montesi, dai delitti del bandito Giuliano e della mafia a quelli del mostro di Firenze, Carlo Lucarelli torna a indagare la parte nascosta dell\'Italia, gli intrecci tuttora inspiegati fra politica, crimine e società in un nuovo libro basato sulla trasmissione televisiva \'Blu notte\'. La narrazione, attraverso gli strumenti letterari del giallo, consente di approfondire le storie rispetto alla sceneggiatura televisiva, ma mantiene costante la fedeltà ai documenti dando voce a tutte le ipotesi e a tutte le piste.', NULL, 'Misteri italia_i_casi_di_blu_notte.jpg', 47),
(49, 'Orlando Furioso', 23, 'Poema cavalleresco di travolgente intensità narrativa e inimitabile equilibrio formale, l\'Orlando furioso ha attraversato ogni epoca e stagione letteraria senza smettere di incantare i propri lettori. Ideale prosecuzione dell\'Orlando innamorato, il Furioso porta ai massimi sviluppi la ricca sostanza umana e artistica dell\'opera boiardesca: il conflitto tra le forze cristiane e quelle musulmane, l\'amore non corrisposto del paladino Orlando per la principessa Angelica, la travagliata unione dinastica tra Ruggiero e Bradamante.', NULL, 'Orlando_furioso.png', 48),
(50, 'Petrademone', 7, 'Quando arriva a Petrademone, la tenuta fra i monti in cui gli zii allevano border collie, Frida ha perso entrambi i genitori ed è chiusa in un bozzolo di dolore. Ma in quello che potrebbe essere il posto ideale dove guarire le ferite dell\'anima, Frida avverte un\'oscura minaccia. Insieme ai suoi tre nuovi amici e altri improbabili alleati, la ragazza comincia così l\'Avventura che cambierà la sua vita per sempre.', NULL, 'Petrademone.png', 49),
(51, 'Programmare con python', 28, 'Un volume con molti esempi pratici alla portata di chiunque, da tenere accanto per scoprire tutti gli aspetti fondamentali, come pure quelli meno evidenti e ugualmente importanti, del linguaggio di programmazione più popolare.', NULL, 'Programmare_con_python.png', 50),
(52, 'Reti di telecomunicazioni', 16, 'Le reti di telecomunicazione rappresentano ormai uno degli elementi più importanti della società globale odierna: esse rimuovono le barriere geografiche consentendo la comunicazione tra persone o calcolatori dovunque situati su questo pianeta.', NULL, 'Reti_di_telecomunicazioni.png', 51),
(53, 'Se questo è un uomo', 9, 'Primo Levi, reduce da Auschwitz, pubblicò \'Se questo è un uomo\' nel 1947. Einaudi lo accolse nel 1958 nei \'Saggi\' e da allora viene continuamente ristampato ed è stato tradotto in tutto il mondo. Testimonianza sconvolgente sull\'inferno dei Lager, libro della dignità e dell\'abiezione dell\'uomo di fronte allo sterminio di massa, \'Se questo è un uomo\' è un capolavoro letterario di una misura, di una compostezza già classiche. È un\'analisi fondamentale della composizione e della storia del Lager, ovvero dell\'umiliazione, dell\'offesa, della degradazione dell\'uomo, prima ancora della sua soppressione nello sterminio.', NULL, 'Se_questo_e_un_uomo.png', 52),
(54, 'Sensori e trasduttori biomedicali', 33, 'Cosa avviene nel corpo quando si applicano stimoli elettrici? A tali domande ed a tante altre risponde questa collana, ideata dal Prof. Giampiero Filella, esperto nella progettazione di molteplici apparecchiature biomedicali e per l\'estetica, nella certezza di offrire agli operatori interessati un utile compendio per completare la loro conoscenza sull\'argomento, migliorando la professionalità nell\'ambito della propria attività.', NULL, 'Sensori_e_trasduttori_biomedicali.png', 53),
(55, 'Sistemi e reti nuova edizione openschool', 28, 'Il corso si propone di fornire i concetti fondamentali per comprendere i meccanismi su cui si fonda il funzionamento dei microprocessori e in particolare di:configurare, installare e gestire sistemi di elaborazione dati e reti;scegliere dispositivi e strumenti in base alle loro caratteristiche funzionali; descrivere e comparare il funzionamento di dispositivi e strumenti elettronici e di telecomunicazione; gestire progetti secondo le procedure e gli standard previsti dai sistemi aziendali di gestione della qualità e della sicurezza; utilizzare le reti e gli strumenti informatici; analizzare il valore, i limiti e i rischi delle varie soluzioni tecniche per la vita sociale e culturale con particolare attenzione alla sicurezza nei luoghi di vita e di lavoro, alla tutela della persona, dell’ambiente e del territorio.', NULL, 'Sistemi_e_reti_nuova_edizione_openschool.jpg', 54),
(56, 'Splinter cell l\'infiltrato', 23, 'Era l\'agente Splinter Cell numero uno,ma ormai non c\'è più posto per Sam Fisher in Third Echelon, l\'agenzia per la sicurezza nazionale degli Usa. Su di lui pesa l\'accusa di aver tradito e ucciso il suo capo.', NULL, 'Splinter_cell_infiltrato.jpg', 55),
(57, 'Tecnologia meccanica', 22, 'Citato in numerose bibliografie dei corsi di tecnologia meccanica, il libro costituisce un classico sull\'argomento. Il testo si caratterizza per un approccio multidisciplinare, che include la trattazione delle interazioni tra i vari materiali, della progettazione e dei processi produttivi. Ogni capitolo è pensato per motivare gli studenti a capire non solo la materia, ma anche l\'importanza che questa sta assumendo nei processi manifatturieri delle diverse nazioni in un contesto di economia globale.', NULL, 'Tecnologia_meccanica.png', 56),
(58, 'Telecomunicazioni', 34, 'Questo nuovo corso di Telecomunicazioni risponde pienamente alle linee guida per il secondo biennio e il quinto anno degli Istituti Tecnici Industriali riformati ad indirizzo Informatica e telecomunicazioni articolazione Informatica (in volume unico) e articolazione Telecomunicazioni (in due volumi).Entrambe le versioni introducono alla disciplina sviluppandone un ampio excursus storico, dalle origini più antiche fino all\'inizio delle telecomunicazioni moderne nate con l\'elettricità.', NULL, 'Telecomunicazioni.png', 57),
(59, 'Twilight', 35, 'Quando Isabella Swann decide di lasciare l\'assolata Phoenix per la fredda e piovosa cittadina di Forks, dove vive suo padre, non immagina certo che la sua vita di teenager timida e introversa conoscerà presto una svolta improvvisa, eccitante e mortalmente pericolosa.Nella nuova scuola tutti la trattano con gentilezza, tutti tranne uno: il misterioso e bellissimo Edward Cullen. Edward non dà confidenza a nessuno. Ma c\'è qualcosa in Bella che costringe Edward dapprima a cercare di stare lontano da lei e quindi ad avvicinarla. Tra i due inizia un\'amicizia sospettosa che man mano si trasforma in un\'attrazione potente, irresistibile. Fino al giorno in cui Edward rivela a Bella il suo segreto.', NULL, 'Twilight.jpg', 58),
(60, 'Ulisse, guida alla lettura', 36, 'Sei anni di intenso lavoro, di stesure e continue revisioni per trasformare il grande mito in grande pantomima. Diciotto episodi, diciotto luoghi, diciotto ore e momenti, diciotto stili, una miriade di personaggi e situazioni per raccontare l\'eroicomica giornata di un ebreo irlandese di origini magiare, l\'agente pubblicitario Leopold Bloom. Un uomo a spasso per Dublino dalle otto alle due di notte del 16 giugno 1904: le sue azioni, i suoi pensieri, le azioni e i pensieri della città, delle cose, della gente che incontra, di Stephen Dedalus, ovvero l\'altra parte di sé, il giovane intellettuale in cerca di un padre (così come Bloom è in cerca di un figlio), di sua moglie Molly, ovvero il grembo da cui si salpa e a cui si ritorna.', NULL, 'Ulisse_guida_alla_lettura.png', 59),
(61, 'Zanna Bianca', 37, 'Siamo in America, ai tempi della corsa all\'oro. Ultimo di una cucciolata, della quale è l\'unico sopravvissuto, è un piccolo cane con una zampa anteriore bianca. La madre Kiche viene adottata da una famiglia di indiani capeggiata da Castoro Grigio,che chiama il piccolo \'Zanna Bianca\'.', NULL, 'Zanna_Bianca.png', 60);

-- --------------------------------------------------------

--
-- Struttura della tabella `prestare`
--

CREATE TABLE `prestare` (
  `Email_Utente` varchar(255) NOT NULL,
  `ID_Libro` int(11) NOT NULL,
  `Voto` int(11) DEFAULT NULL,
  `Data_Riconsegna` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Data_Prestito` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `Telefono` varchar(255) DEFAULT NULL,
  `Data_Registrazione` date DEFAULT NULL,
  `Cognome` varchar(255) DEFAULT NULL,
  `Nome` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Password1` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `appartiene`
--
ALTER TABLE `appartiene`
  ADD PRIMARY KEY (`ID_Libro`,`Nome_Categoria`),
  ADD KEY `Nome_Categoria` (`Nome_Categoria`);

--
-- Indici per le tabelle `autore`
--
ALTER TABLE `autore`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Nome`);

--
-- Indici per le tabelle `editore`
--
ALTER TABLE `editore`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Codice_Editore` (`Codice_Editore`),
  ADD KEY `libro_ibfk_2` (`ID_Autore`);

--
-- Indici per le tabelle `prestare`
--
ALTER TABLE `prestare`
  ADD PRIMARY KEY (`Email_Utente`,`ID_Libro`,`Data_Prestito`),
  ADD KEY `ID_Libro` (`ID_Libro`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `autore`
--
ALTER TABLE `autore`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT per la tabella `editore`
--
ALTER TABLE `editore`
  MODIFY `Codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT per la tabella `libro`
--
ALTER TABLE `libro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `appartiene`
--
ALTER TABLE `appartiene`
  ADD CONSTRAINT `appartiene_ibfk_1` FOREIGN KEY (`ID_Libro`) REFERENCES `libro` (`ID`),
  ADD CONSTRAINT `appartiene_ibfk_2` FOREIGN KEY (`Nome_Categoria`) REFERENCES `categoria` (`Nome`);

--
-- Limiti per la tabella `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`Codice_Editore`) REFERENCES `editore` (`Codice`),
  ADD CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`ID_Autore`) REFERENCES `autore` (`ID`);

--
-- Limiti per la tabella `prestare`
--
ALTER TABLE `prestare`
  ADD CONSTRAINT `prestare_ibfk_1` FOREIGN KEY (`Email_Utente`) REFERENCES `utente` (`Email`),
  ADD CONSTRAINT `prestare_ibfk_2` FOREIGN KEY (`ID_Libro`) REFERENCES `libro` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
