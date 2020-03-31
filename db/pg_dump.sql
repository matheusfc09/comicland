-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2012 at 10:42 
-- Server version: 5.5.8
-- PHP Version: 5.3.5

/* SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"; */


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comic_land`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_comments`
--

CREATE SEQUENCE board_comments_seq;

CREATE TABLE IF NOT EXISTS board_comments (
  id mediumint check (id > 0) NOT NULL DEFAULT NEXTVAL ('board_comments_seq'),
  user_id mediumint check (user_id > 0) NOT NULL,
  topic_id mediumint check (topic_id > 0) NOT NULL,
  comment text NOT NULL,
  creation timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)    ;
 
ALTER SEQUENCE board_comments_seq RESTART WITH 15;

CREATE INDEX user_id ON board_comments (user_id);
CREATE INDEX board_comments_ibfk_2 ON board_comments (topic_id);

--
-- Dumping data for table `board_comments`
--

INSERT INTO board_comments (id, user_id, topic_id, comment, creation) VALUES
(1, 3, 1, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy', '2012-11-14 09:44:36'),
(2, 2, 1, 'Fusce ultrices placerat magna, dignissim molestie nibh dictum sit amet. Nunc dapibus, arcu facilisis eleifend sodales, mi risus suscipit risus, vitae adipiscing velit dolor at sapien. Nunc commodo dolor ac eros commodo lacinia. Vestibulum sit amet dolor elit, eget interdum mi. In sed elit at dolor posuere faucibus sit amet ut eros. Aenean venenatis pulvinar libero, condimentum bibendum arcu ullamcorper eu. Praesent mauris dui, porttitor id tempor at, euismod sed odio. Nullam molestie, arcu sed rhoncus aliquet, nunc ante ullamcorper magna, eu adipiscing sapien nunc ut odio. Vivamus viverra felis sit amet turpis ultricies vel volutpat orci dignissim. Praesent lobortis bibendum lorem sed gravida. Donec ac convallis libero. Aenean porta euismod orci, quis venenatis purus aliquet gravida. Ut nisi elit, interdum in mattis ac, varius non urna. Suspendisse quis eros velit. Aenean quam sapien, commodo a convallis sed, posuere id nisi. Suspendisse id mi nec purus molestie fringilla.', '2012-11-15 00:05:55'),
(9, 10, 2, 'Ut elit leo, viverra id gravida sit amet, tempor id massa. In hac habitasse platea dictumst. Nulla tincidunt sem purus. Vivamus ut lacus ut neque euismod placerat nec in justo. Nunc vehicula arcu dictum libero eleifend id rhoncus velit viverra. Morbi pretium mollis urna in adipiscing. Vivamus eleifend nisl in felis congue ut bibendum sapien gravida', '2012-11-15 01:03:08'),
(10, 10, 2, 'Donec quam tortor, vestibulum ut tincidunt in, congue sed lacus. Vestibulum a dolor sem. Pellentesque facilisis congue ante sed dapibus. Sed eleifend eleifend massa, ac adipiscing mauris dictum vel. Fusce non commodo ligula. Vivamus et nisl ac lectus facilisis iaculis nec non magna. Ut ultrices, augue sed dapibus hendrerit, libero leo pretium tellus, sit amet lobortis est velit non ipsum. Sed sollicitudin velit pharetra eros blandit vel sollicitudin purus feugiat.<br />rnPhasellus vel diam eu arcu <b>tempor</b> bibendum sodales quis nulla. In id odio enim, vitae iaculis dolor. Mauris convallis aliquam justo nec dictum. Maecenas lacinia leo sed ante bibendum non mattis risus fermentum. Fusce tellus arcu, sodales non consectetur at, congue ut risus. Quisque at varius odio.', '2012-11-15 01:03:45'),
(11, 10, 1, 'Bla bla bla bla', '2012-11-15 10:00:13'),
(12, 10, 3, 'Ele Ã© mesmo gay!', '2012-11-15 11:21:10'),
(13, 3, 3, 'Definitely! Integer ut neque ac lacus ullamcorper rutrum. Quisque tincidunt scelerisque malesuada. Fusce orci urna, interdum eu commodo ut, fermentum vel sapien.', '2012-11-15 13:07:07'),
(14, 3, 5, 'Unfortunately yes, that''s what happened!', '2012-11-15 13:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `board_topics`
--

CREATE SEQUENCE board_topics_seq;

CREATE TABLE IF NOT EXISTS board_topics (
  id mediumint check (id > 0) NOT NULL DEFAULT NEXTVAL ('board_topics_seq'),
  title varchar(200) NOT NULL,
  entry text NOT NULL,
  character_id mediumint check (character_id > 0) NOT NULL,
  PRIMARY KEY (id)
)    ;
 
ALTER SEQUENCE board_topics_seq RESTART WITH 6;

CREATE INDEX character_id ON board_topics (character_id);

--
-- Dumping data for table `board_topics`
--

INSERT INTO board_topics (id, title, entry, character_id) VALUES
(1, 'Can he dance the break?', 'If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 6),
(2, 'Is it true he is dating the Wonder Woman?', 'Donec quam tortor, vestibulum ut tincidunt in, congue sed lacus. Vestibulum a dolor sem. Pellentesque facilisis congue ante sed dapibus. Sed eleifend eleifend massa, ac adipiscing mauris dictum vel. Fusce non commodo ligula. Vivamus et nisl ac lectus facilisis iaculis nec non magna. Ut ultrices, augue sed dapibus hendrerit, libero leo pretium tellus, sit amet lobortis est velit non ipsum.', 6),
(3, 'Is Aquaman Gay?', 'Fusce ultrices placerat magna, dignissim molestie nibh dictum sit amet. Nunc dapibus, arcu facilisis eleifend sodales, mi risus suscipit risus, vitae adipiscing velit dolor at sapien. Nunc commodo dolor ac eros commodo lacinia. Vestibulum sit amet dolor elit, eget interdum mi. In sed elit at dolor posuere faucibus sit amet ut eros. Aenean venenatis pulvinar libero, condimentum bibendum arcu ullamcorper eu.rnPraesent mauris dui, porttitor id tempor at, euismod sed odio. Nullam molestie, arcu sed rhoncus aliquet, nunc ante ullamcorper magna, eu adipiscing sapien nunc ut odio. Vivamus viverra felis sit amet turpis ultricies vel volutpat orci dignissim. Praesent lobortis bibendum lorem sed gravida. Donec ac convallis libero. Aenean porta euismod orci, quis venenatis purus aliquet gravida. Ut nisi elit, interdum in mattis ac, varius non urna. Suspendisse quis eros velit. Aenean quam sapien, commodo a convallis sed, posuere id nisi. Suspendisse id mi nec purus molestie fringilla.', 34),
(5, 'Superman: Good or Evil?', 'Donec quam tortor, vestibulum ut tincidunt in, congue sed lacus. Vestibulum a dolor sem. Pellentesque facilisis congue ante sed dapibus. Sed eleifend eleifend massa, ac adipiscing mauris dictum vel. Fusce non commodo ligula. Vivamus et nisl ac lectus facilisis iaculis nec non magna. Ut ultrices, augue sed dapibus hendrerit, libero leo pretium tellus, sit amet lobortis est velit non ipsum.', 6);

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE SEQUENCE characters_seq;

CREATE TABLE IF NOT EXISTS characters (
  id mediumint check (id > 0) NOT NULL DEFAULT NEXTVAL ('characters_seq'),
  name varchar(50) CHARACTER SET utf8 NOT NULL,
  gender varchar(1) CHARACTER SET utf8 DEFAULT 'm',
  description text CHARACTER SET utf8 NOT NULL,
  powers text CHARACTER SET utf8 NOT NULL,
  img_name varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT name UNIQUE  (name)
)    ;
 
ALTER SEQUENCE characters_seq RESTART WITH 40;

--
-- Dumping data for table `characters`
--

INSERT INTO characters (id, name, gender, description, powers, img_name) VALUES
(1, 'Catwoman', 'f', 'Proin hendrerit, magna et suscipit tempor, nulla ipsum dapibus odio, vitae fermentum diam sapien at lorem. Suspendisse ipsum sapien, cursus nec luctus vel, condimentum sed mauris. Nullam rhoncus magna a lacus tempus faucibus. Pellentesque non nibh ligula. Donec laoreet orci justo, adipiscing faucibus risus. Nunc quis ipsum sem. Maecenas vestibulum tristique justo non laoreet. In vel lacus vitae felis imperdiet egestas at fermentum nunc. Aliquam sem quam, tristique et pulvinar vel, pharetra sit amet orci. In dictum pulvinar nulla, vitae ultrices mauris ultricies sit amet. In cursus dapibus rhoncus. Phasellus ut blandit dolor. Ut et neque augue. In hac habitasse platea dictumst. Integer dictum lectus a leo commodo eget euismod nibh eleifend. Proin sollicitudin pulvinar ipsum, ac porttitor magna varius pharetra.<br />rn<br />rnNunc odio neque, pellentesque eu molestie eu, varius sit amet neque. Sed facilisis tellus nec est consectetur tempus. Morbi ornare sem non urna hendrerit luctus. Nulla lectus erat, lacinia et egestas non, suscipit non sem. Curabitur sit amet ullamcorper leo. Ut tristique, lacus ac convallis porttitor, urna velit porttitor risus, et aliquam libero enim non ipsum. Proin eget quam eu velit condimentum vestibulum. Etiam lorem augue, rutrum ac fringilla nec, eleifend vel sapien. Morbi iaculis, lorem sed interdum elementum, lorem elit posuere mauris, ac placerat sem orci ut tortor. Nulla viverra tempus ante vel venenatis. Aenean convallis gravida nisl eu sollicitudin. In mi mi, scelerisque vel elementum a, posuere eu augue. Sed rutrum suscipit libero, vitae blandit purus lacinia vel. Quisque in iaculis eros. Donec sit amet rhoncus ante. Proin tempus dapibus purus, sit amet luctus nulla pellentesque vitae.', 'Integer ut neque ac lacus ullamcorper rutrum. Quisque tincidunt scelerisque malesuada. Fusce orci urna, interdum eu commodo ut, fermentum vel sapien. Sed sed erat in massa convallis varius. Donec semper, sapien eu gravida vestibulum, felis orci malesuada urna, in aliquet felis nulla vel magna. Etiam a velit at sapien sagittis iaculis. Vivamus ante arcu, laoreet id sagittis id, vehicula ut nunc. Nulla a augue nulla. Maecenas et venenatis tortor.', 'img/characters/1.png'),
(2, 'Storm', NULL, '', '', 'img/characters/2.png'),
(3, 'Iron Man', 'm', '', '', 'img/characters/3.png'),
(4, 'Wolverine', 'm', 'The man who would be known as the superhero named Wolverine was born as James Howlett Hudson in the mid 1880s in Alberta, Canada. The second and sickly child to Elizabeth and John Howlett Sr. His mother was ill and, in the early 1900s, a young Irish girl named Rose O''Hara was brought to the Howlett estate to be a friend and a caretaker to young James. Together they befriended a young boy named Dog, son of the grounds keeper, Thomas Logan. Dog tried to form a normal bond between the two, but due to his fatherâ€™s drunken abuse, he grew to resent the pair and plotted with his father against them. After a botched robbery turns into a successful murder, young Jamesâ€™ powers suddenly manifest and he stabs Thomas with his newly drawn claws, also slashing Dog across the face before fainting. He and Rose flee the house and make their way through the harsh Canadian wilderness with James near-catatonic and Rose having to facilitate their transportation.<br />rn<br />rnThey arrive at a mine where Rose gives false names, calling James â€œLogan.â€ The other workers dub the revived Logan â€œthe wolverineâ€ because of his penchant for tenaciously digging and begin to accept him as one of their own due to his incredible work ethic. What they donâ€™t know is that by night, he runs in the wild with a pack of wolves that he is cowed the alpha of. Dog arrives one day, having survived his encounter years ago, still holding a massive grudge against Logan. Logan recognizes his erstwhile friend and accepts his challenge to a brawl to the death. Before Logan can kill Dog, however, Rose tries to pull him away and is inadvertently stabbed through the chest, killing her and leaving Logan to mourn alone.', '<i>Regenerative Healing Factor:</i> Wolverine''s most prominent power is his healing factor. This allows Wolverine to heal from virtually any injury at an incredibly fast rate. This allows him take hits from class 100+ characters and continue fighting. He can regrow missing limbs, organs and has even regenerated his entire skeleton. His healing factor grants him a high resistance to toxins and poisons. Large enough doses have proven effective at bypassing his healing factor. His healing also grants him immunity to all Earthly diseases and it extends Wolverine''s lifespan. Wolverine''s healing factor depends on his body''s state. So if Wolverine lacks sleep and proper nutrition for a time, it slows his healing abilities drastically.<br />rn<br />rn<i>Superhuman Strength:</i> Wolverine is superhumanly strong. His strength ranges from beyond 800 pounds, but no more than 2 tons. Wolverine has swung tree trunks around like baseball bats, held an elevator with one hand, punched into steel and his blows have knocked out super durable foes like Roughhouse.<br />rn<br />rn<i>Superhuman Agility:</i> Wolverine''s balance and agility as well as his body coordination is beyond the capabilities of a human being at its peak and is well into the superhuman range. Wolverine has also been seen to jump nearly 30ft in the air unassisted.<br />rn<br />rn<i>Bone Claws:</i> Wolverine possesses 6, 12 inch retractable bone claws. 3 are in each arm and are housed in his forearms. When extended they tear through the flesh in his knuckles but his healing factor heals the injuries virtually instantaneously. The bone claws are able to tear through most types of flesh and have been able to cut through stone and even steel. Combined with the adamantium, Wolverine''s claws are capable of cutting through virtually anyone and anything.', 'img/characters/4.png'),
(5, 'Spider Man', NULL, '', '', 'img/characters/5.png'),
(6, 'Superman', NULL, '', '', 'img/characters/6.png'),
(7, 'Batman', NULL, '', '', 'img/characters/7.png'),
(8, 'Hulk', NULL, '', '', 'img/characters/8.png'),
(9, 'Wonder Woman', NULL, '', '', 'img/characters/9.png'),
(10, 'Green Lantern', 'm', '', '', 'img/characters/10.png'),
(25, 'Gisele Bundchen', 'f', '', '', 'img/characters/25.png'),
(27, 'Captain America', 'm', '', '', 'img/characters/27.png'),
(28, 'Magneto', 'm', '', '', 'img/characters/28.png'),
(29, 'Zatana', 'f', '', '', 'img/characters/29.png'),
(30, 'Carla Perez', 'f', '', '', 'img/characters/30.png'),
(31, 'Thor', 'm', 'Thor is the son of the Odin, All-father of the Asgardian Gods, and the elder goddess Gaea, the living embodiment of Earth itself. Thor was born centuries ago in a cave in Norway in modern times. Once Thor was weened, Odin brought him to Asgard where he was raised to be the God of Thunder and heir to the throne. As the Asgardian God of Thunder, Thor commands the thunder, the lightning the wind and all the elements of the storm with his hammer Mjolnir, which was forged from the legendary, indestructible Asgardian metal; Uru. Mjolnir gives Thor the power of flight and helps him channel, focus or amplify his own godly elemental powers.<br />rn<br />rnThough the hammer is quite heavy by mortal standards, It can only be lifted by those deemed worthy to do so, regardless of the would-be wielderâ€™s physical strength. After centuries of defending Asgard from it''s enemies, Thor became too proud and grew headstrong. It was because of this that he was banished to Midgard (Earth) by his father to teach him humility. Made mortal and given the form of the handicapped human doctor Donald Blake, Thor learned what it was like to be small and frail and how to be humble and truly noble despite being mortal. When in his mortal guise of Dr. Blake he is able to transform into his true godly form by striking his walking stick (actually Mjolnir in disguise) upon any solid surface causing the transformation that changes him into Thor and his walking stick into his hammer Mjolnir.', '<i>Strength: </i>Thor is physically the strongest of the Norse Gods being the son of Odin and the elder goddess Gaea. Thor has shown strength in excess of the Class 100 and can lift well over 100 tons. He has demonstrated strength enough to destroy the board of the Silver Surfer, defeat Namor and Gladiator in one to one hand combat, challenge and defeat Abomination as well as match the strength of Savage Hulk for an entire hour while Savage Hulk''s strength was rising increasingly due to rage. Thor has also been shown matching Hercules in several contests of strength, although never overpowering him, once sending the planet out of orbit in an arm wrestle with him. One of Thorâ€™s greatest feats of strength was when he displayed the ability to lift the Midgard Serpent, which has stated to be so large that it could wrap itself around Earth several times and also crush it. On occasions Thor has shown the ability that he can destroy moons using his bare hands and also destroy planets with his powerful strikes. He displayed this ability when he hit Beta Ray Bill so hard that he destroyed the planet that they were on. Thor usually holds back so that he does not kill his opponents or affect greatly the area in which they are in. Thorâ€™s strength is comparable to beings such as Hulk, Hercules, Sentry and Gladiator. If Thor is pushed far enough in battle he sometimes enters a berserker mental-state of being called "The Warrior''s Madness". This increases his strength tenfold but has adverse psychological effects. Odin himself stated an inability to cure the The Warrior''s Madness, when a maddened Thor obtained the Power Gem and fought, but was defeated by Thanos. This berserker also state tires Thorâ€™s body extremely and it also affects his ability to discern from friend or foe.<br />rn<br />rn<i>Invulnerability:</i> Thorâ€™s physiology is a product of his half-Asgardian/ half-Elder God heritage grants him a level of invulnerability that is not common amongst those of his race. Thor has been shown to be immune to all human diseases as well as its poisons and toxins. Thor is also immune to electrocution and radiation poisoning and his metabolism is so great that it is impossible for Thor to become drunk. Though Thor is one of the most invulnerable of Marvel''s heroes he is not immune to all forms of harm and can be injured by a being whose power matches or exceeds his own, or by high order magic manipulation.<br />rn<br />rn<i>Flight:</i> Thor naturally does not have the ability to fly but by swinging and throwing his weapon, Mjolnir, he can. With this weapon When Thor is using Mjolnir for flight, he is extremely fast. Thor has been seen flying to the sun in minutes. Although Thor uses Mjolnir for flight, he is able to levitate without it.<br />rn<br />rn<i>Tectonic Control: </i>After Thor was resurrected he came to terms with the fact that he was the son of the Elder Goddess Gaea and was granted the ability to control the Earth and has displayed this ability by creating very powerful earthquakes. Thor also displayed this ability when he created a chasm in Africa between two different areas to prevent the enemies of one side from entering the territory of the other.', 'img/characters/31.png'),
(34, 'Aquaman', 'm', 'According to his first origin story, Aquaman a.k.a. Arthur Curry was the son of Atlanna, an Atlantean princess banished from Atlantis due to her interest in and frequent visits to the surface world; and Tom Curry, a surface man and lighthouse keeper. One night, amidst a terrible storm, Tom Curry would find Atlanna thrown up on the shore by storm-tossed waves, and rescue her from harm. Both Curry and Atlanna made the lighthouse their home and developed a strong bond that would quickly lead to a sentimental relationship, which in turn, would later lead to the birth of Arthur Curry.<br />rn<br />rnTom Curry accepted his relationship with Atlanna, and though he always knew there was more to her than she would let on, he''d never ask her about her origins. After Arthur was born, all of that became even more irrelevant as his presence there cemented the bond between the two. Two years after his birth, young Arthur was found by his father playing underwater after he had apparently been there for an hour without drowning. Several years later, both Tom and Arthur himself would learn the truth about Atlanna''s origins, as she would reveal that she came from the lost continent of Atlantis while she lay in her deathbed. Atlanna would also reveal to Arthur that he had inherited her ability to live and breathe underwater, as well as her power to communicate with and control all marine life.<br />rn<br />rnAfter Atlanna''s death, Arthur''s father became determined to train him both phisically and mentally so that he would one day be in complete control of his powers. Arthur was also taught by his father to view himself as someone special, as a savior of the oceans, as The King of the Seven Seas. Later, after his father''s death, Arthur Curry would leave the lighthouse which had been a home to him and his family for years, to venture into the oceans and find his true destiny. He would later become the king of Atlantis and marry Mera, a visitor from an other-dimensional water-world know as Xebel. He would also take young Aqualad under his wing and fight the forces of evil side by side with the occasional help of his wife, Mera.', '<i>Telepathic:</i> Orin has many powers, but his telepathic ability to communicate with marine life is known most widely. He can summon from great distances. Although this power is most often and most easily used on marine life, Aquaman has demonstrated the capacity to affect any being that lives upon the sea or even any being evolved from marine life. His telepathy works best on marine life, but that has not stopped him from using mind control on other telepaths.<br />rn<br />rn<i>Enhanced Senses:</i> He can see in near total darkness and has enhanced hearing granting limited sonar. Although he can remain underwater indefinitely without suffering any ill effects, Aquaman grows weak if he remains on land for extended periods.<br />rn<br />rn<i>Magic:</i> The mechanical hand was replaced by a magical hand made out of water given to him by the Lady of the Lake, which grants Aquaman numerous abilities, the ability to dehydrate anyone he touches with it, killing them instantly, the ability to change the shape and density of the hand for example Orin can make his hand into a sword or harder than steel, the ability to shoot jets of scalding water, healing abilities the ability to create portals into mystical dimensions the ability to communicate with the Lady of the Lake through the water bearer hand and the ability to nullify magic even powerful sorcerers like Tempest. Since transformation to the Dweller and his return to the living now appears to have a normal hand. Whether he retains any mystic abilities has yet to be determined.', 'img/characters/34.png'),
(39, 'Silver Surfer', 'm', 'Nam vel venenatis nisl. Aliquam a leo a urna placerat accumsan non id nisi. Etiam sem ante, posuere nec bibendum nec, sodales eget augue. Suspendisse mollis mattis sem ut hendrerit. Morbi ultrices commodo leo et rutrum. Praesent ut dolor sed quam bibendum sollicitudin. Quisque orci sapien, gravida ac tempor quis, facilisis sollicitudin nunc. Integer sollicitudin euismod magna et vestibulum. Duis sit amet augue nisl. In id nunc ante. Donec placerat, lacus vitae sodales vulputate, velit nisl pharetra quam, quis accumsan nisi massa a ante. Mauris consequat est et massa scelerisque elementum. Vestibulum augue nisi, luctus eu mattis ac, venenatis vel tellus. Mauris tincidunt, velit sit amet rutrum pharetra, tortor sapien tincidunt dolor, id congue massa lectus eget elit.<br />rn<br />rnNam vel venenatis nisl. Aliquam a leo a urna placerat accumsan non id nisi. Etiam sem ante, posuere nec bibendum nec, sodales eget augue. Suspendisse mollis mattis sem ut hendrerit. Morbi ultrices commodo leo et rutrum. Praesent ut dolor sed quam bibendum sollicitudin. Quisque orci sapien, gravida ac tempor quis, facilisis sollicitudin nunc. Integer sollicitudin euismod magna et vestibulum. Duis sit amet augue nisl. In id nunc ante. Donec placerat, lacus vitae sodales vulputate, velit nisl pharetra quam, quis accumsan nisi massa a ante. Mauris consequat est et massa scelerisque elementum. Vestibulum augue nisi, luctus eu mattis ac, venenatis vel tellus. Mauris tincidunt, velit sit amet rutrum pharetra, tortor sapien tincidunt dolor, id congue massa lectus eget elit.<br />rn<br />rnNam vel venenatis nisl. Aliquam a leo a urna placerat accumsan non id nisi. Etiam sem ante, posuere nec bibendum nec, sodales eget augue. Suspendisse mollis mattis sem ut hendrerit. Morbi ultrices commodo leo et rutrum. Praesent ut dolor sed quam bibendum sollicitudin. Quisque orci sapien, gravida ac tempor quis, facilisis sollicitudin nunc. Integer sollicitudin euismod magna et vestibulum. Duis sit amet augue nisl. In id nunc ante. Donec placerat, lacus vitae sodales vulputate, velit nisl pharetra quam, quis accumsan nisi massa a ante. Mauris consequat est et massa scelerisque elementum. Vestibulum augue nisi, luctus eu mattis ac, venenatis vel tellus. Mauris tincidunt, velit sit amet rutrum pharetra, tortor sapien tincidunt dolor, id congue massa lectus eget elit.', 'Nam vel venenatis nisl. Aliquam a leo a urna placerat accumsan non id nisi. Etiam sem ante, posuere nec bibendum nec, sodales eget augue. Suspendisse mollis mattis sem ut hendrerit. Morbi ultrices commodo leo et rutrum. Praesent ut dolor sed quam bibendum sollicitudin. Quisque orci sapien, gravida ac tempor quis, facilisis sollicitudin nunc. Integer sollicitudin euismod magna et vestibulum. Duis sit amet augue nisl. In id nunc ante. Donec placerat, lacus vitae sodales vulputate, velit nisl pharetra quam, quis accumsan nisi massa a ante. Mauris consequat est et massa scelerisque elementum. Vestibulum augue nisi, luctus eu mattis ac, venenatis vel tellus. Mauris tincidunt, velit sit amet rutrum pharetra, tortor sapien tincidunt dolor, id congue massa lectus eget elit.<br />rn<br />rnNam vel venenatis nisl. Aliquam a leo a urna placerat accumsan non id nisi. Etiam sem ante, posuere nec bibendum nec, sodales eget augue. Suspendisse mollis mattis sem ut hendrerit. Morbi ultrices commodo leo et rutrum. Praesent ut dolor sed quam bibendum sollicitudin. Quisque orci sapien, gravida ac tempor quis, facilisis sollicitudin nunc. Integer sollicitudin euismod magna et vestibulum. Duis sit amet augue nisl. In id nunc ante. Donec placerat, lacus vitae sodales vulputate, velit nisl pharetra quam, quis accumsan nisi massa a ante. Mauris consequat est et massa scelerisque elementum. Vestibulum augue nisi, luctus eu mattis ac, venenatis vel tellus. Mauris tincidunt, velit sit amet rutrum pharetra, tortor sapien tincidunt dolor, id congue massa lectus eget elit.', 'img/characters/39.png');

-- --------------------------------------------------------

--
-- Table structure for table `comics`
--

CREATE SEQUENCE comics_seq;

CREATE TABLE IF NOT EXISTS comics (
  id mediumint check (id > 0) NOT NULL DEFAULT NEXTVAL ('comics_seq'),
  series varchar(50) NOT NULL,
  title varchar(100) DEFAULT NULL,
  issue int NOT NULL,
  publisher varchar(50) NOT NULL,
  img_name varchar(50) NOT NULL,
  summary text NOT NULL,
  PRIMARY KEY (id)
)    ;
 
ALTER SEQUENCE comics_seq RESTART WITH 5;

--
-- Dumping data for table `comics`
--

INSERT INTO comics (id, series, title, issue, publisher, img_name, summary) VALUES
(2, 'Superboy', 'Superboys and Their Toys', 2, 'DC Comics', 'img/comics/2.jpeg', 'Project N.O.W.H.E.R.E. has put a lot of effort into creating their Superboy, and they intend to make sure he performs to their standards. And what better opportunity for him to demonstrate his raw power than to throw him into an alien prison riot? Good luck, Superboyâ€¦ you''re going to need it!<br />rn<br />rnUt facilisis venenatis laoreet. Proin eleifend odio ac enim dictum ullamcorper. Donec adipiscing lacus a nulla euismod gravida. Suspendisse vel mi tortor. Pellentesque turpis lectus, dictum in semper ac, tempus at odio. Integer non neque vel tellus sagittis commodo eu eu enim. Donec ac feugiat enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis in justo ut leo bibendum bibendum eget a lacus. Nunc turpis nulla, auctor sed hendrerit vel, dictum et nisi. Morbi gravida purus vel tellus volutpat scelerisque. Nam tincidunt convallis cursus. Pellentesque sodales, libero vitae imperdiet tempor, odio lectus porta orci, non venenatis nisl lorem sit amet quam. Aenean tellus elit, varius eget commodo a, placerat nec metus. Nam egestas augue molestie nisi aliquam gravida.'),
(3, 'Facebook', 'Como Mark Zuckerberg te Matou', 45, 'Facebook Co', 'img/comics/3.jpg', 'Fusce ultrices placerat magna, dignissim molestie nibh dictum sit amet. Nunc dapibus, arcu facilisis eleifend sodales, mi risus suscipit risus, vitae adipiscing velit dolor at sapien. Nunc commodo dolor ac eros commodo lacinia. Vestibulum sit amet dolor elit, eget interdum mi. In sed elit at dolor posuere faucibus sit amet ut eros. Aenean venenatis pulvinar libero, condimentum bibendum arcu ullamcorper eu. Praesent mauris dui, porttitor id tempor at, euismod sed odio. Nullam molestie, arcu sed rhoncus aliquet, nunc ante ullamcorper magna, eu adipiscing sapien nunc ut odio. Vivamus viverra felis sit amet turpis ultricies vel volutpat orci dignissim. Praesent lobortis bibendum lorem sed gravida. Donec ac convallis libero. Aenean porta euismod orci, quis venenatis purus aliquet gravida. Ut nisi elit, interdum in mattis ac, varius non urna. Suspendisse quis eros velit. Aenean quam sapien, commodo a convallis sed, posuere id nisi. Suspendisse id mi nec purus molestie fringilla.'),
(4, 'Batgirl', 'A Courtship of Razors', 14, 'DC Comics', 'img/comics/4.jpeg', '<i>The Good:</i> I''ve always seen Barbara Gordon as a truly kick ass character. She came a long way in the pre-New 52 as Batgirl and Oracle after she was shot by the Joker. It''s been over a year and it is still a little strange seeing her back in her Batgirl attire. Because of the overall direction of the New 52 universe, Barbara has felt as if she lost a little of her edge. That changes with this issue. The idea of a cross title crossover story dealing with the Joker is fascinating as he has specific reason for going after each member of the Bat-Family. With Barbara, this is a confrontation you won''t want to miss. With the change in the timeline and how little she''s had to deal with being shot and paralyzed, the event is still fresh and the (mental) wounds may not have fully healed. Throw in her mom being placed in danger after she just started reconnecting with her, this is going to be a Batgirl Joker might regret dealing with.<br />rnGail Simone does a great job with the psychological angle of the story. Every instinct in Barbara screams to go out and seek vengeance for what happened and to save her mother. With a nice twist, her hands are a little tied and she is forced to play by the rules of other. Of course there''s also the big theme we''re also seeing in this week''s BATMAN as to what exactly does Joker know? If he does know Batgirl''s secret identity, that makes him an even bigger threat than he normally would be. Ed Benes and Daniel Sampere do a great job in the action scenes when Barbara''s place is invaded. The scenes preceding the action, with the agony Barbara goes through in dealing with everything that is going on is great as well. Aside from being a part of the "Death of the Family" crossover, it just felt like the overall vibe of the book was amped up in this issue.<br />rn<br />rn<i>The Bad:</i> I love a good twist as much as the next person. I''m really torn about a twist that happens in this issue. On the one hand, it''s surprising and definitely opens up a new can of worms. On the other, it almost feels exploitive because of the character involved. That may not make sense to some but I am concerned with what the New 52 version of this character will be. It does make sense how the character is used in this context and I will definitely reserve full judgement until seeing how it all plays out.<br />rnWhile I did enjoy the opening and fight scenes, Barbara''s mom and Joker looked a little off. This could be the result of two artists but Joker also (unfortunately) didn''t look quite as creepy as he should in his present condition. He almost looked more comical than the fierce threat he should be right now. Sure, every artist has their own interpretation but as part of the overall crossover, it almost felt like a different Joker seen in the other books.<br />rn<br />rn<i>The Verdict:</i> Barbara Gordon should be a character that kicks all sorts of ass and that''s exactly what she does in this issue. We''ve been seeing a bit of a roller coaster ride as she''s been getting back into the swing of things since recovering from being shot and paralyzed. This is the Barbara I want to see. Gail Simone does a great job showing the inner struggle in coming to terms and facing her demons and the Joker. She was a victim once and that was the last time. We''ve all been waiting for round two of Barbara vs Joker and this is just the beginning of that. The art is a mix of being really great throughout most of the issue with a couple moments it falls flat a little. You would think the return of the Joker would be a bad thing for Batgirl but it''s showing that she is ready fully deal with what happened and is now ready to take on anyone that gets in her way.');

-- --------------------------------------------------------

--
-- Table structure for table `comics_characters`
--

CREATE TABLE IF NOT EXISTS comics_characters (
  character_id mediumint check (character_id > 0) NOT NULL,
  comic_id mediumint check (comic_id > 0) NOT NULL,
  PRIMARY KEY (character_id,comic_id)
) ;

--
-- Dumping data for table `comics_characters`
--

INSERT INTO comics_characters (character_id, comic_id) VALUES
(6, 2),
(6, 3),
(6, 4),
(7, 3),
(7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `comic_ratings`
--

CREATE TABLE IF NOT EXISTS comic_ratings (
  user_id mediumint check (user_id > 0) NOT NULL,
  comic_id mediumint check (comic_id > 0) NOT NULL,
  rate mediumint check (rate > 0) NOT NULL,
  PRIMARY KEY (user_id,comic_id)
) ;

CREATE INDEX comic_ratings_comic_id ON comic_ratings (comic_id);

--
-- Dumping data for table `comic_ratings`
--

INSERT INTO comic_ratings (user_id, comic_id, rate) VALUES
(2, 3, 5),
(3, 2, 5),
(3, 3, 3),
(10, 2, 2),
(10, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `favorite_characters`
--

CREATE TABLE IF NOT EXISTS favorite_characters (
  user_id mediumint check (user_id > 0) NOT NULL,
  character_id mediumint check (character_id > 0) NOT NULL,
  PRIMARY KEY (user_id,character_id)
) ;

CREATE INDEX character_id ON favorite_characters (character_id);

--
-- Dumping data for table `favorite_characters`
--

INSERT INTO favorite_characters (user_id, character_id) VALUES
(2, 1),
(2, 3),
(1, 6),
(2, 6),
(2, 7),
(3, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 39);

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE SEQUENCE news_feed_seq;

CREATE TABLE IF NOT EXISTS news_feed (
  id mediumint check (id > 0) NOT NULL DEFAULT NEXTVAL ('news_feed_seq'),
  action varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  type varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  content varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  link varchar(100) CHARACTER SET utf8 NOT NULL,
  user_id mediumint check (user_id > 0) NOT NULL,
  date timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)     ;
 
ALTER SEQUENCE news_feed_seq RESTART WITH 13;

CREATE INDEX user_id ON news_feed (user_id);

--
-- Dumping data for table `news_feed`
--

INSERT INTO news_feed (id, action, type, content, link, user_id, date) VALUES
(3, 'added a new', 'comic book', 'Batman Begins', 'comic.php?id=2', 3, '2012-11-15 11:43:02'),
(4, 'added a new', 'character', 'Zatana', 'character.php?id=29', 10, '2012-11-15 12:03:59'),
(6, 'created a new', 'character', 'Silver Surfer', 'character.php?id=39', 10, '2012-11-15 12:49:54'),
(7, 'updated a', 'character', 'Catwoman', 'character.php?id=1', 10, '2012-11-15 12:53:46'),
(8, 'created a new', 'comic book', 'Batgirl: A Courtship of Razors', 'comic.php?id=4', 3, '2012-11-15 12:58:26'),
(9, 'commented on a', 'discussion board', '''Definitely! Int...''', 'character.php?id=34', 3, '2012-11-15 13:07:07'),
(10, 'commented on a', 'discussion board', '''Unfortunately yes, t...''', 'character.php?id=6', 3, '2012-11-15 13:08:19'),
(11, 'reviewed a', 'comic book', '''Proin hendrerit, mag...''', 'comic.php?id=4', 3, '2012-11-15 13:11:17'),
(12, 'updated a', 'comic book', 'Batgirl: A Courtship of Razors', 'comic.php?id=4', 3, '2012-11-15 13:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE SEQUENCE reviews_seq;

CREATE TABLE IF NOT EXISTS reviews (
  id mediumint check (id > 0) NOT NULL DEFAULT NEXTVAL ('reviews_seq'),
  entry text NOT NULL,
  user_id mediumint check (user_id > 0) NOT NULL,
  comic_id mediumint check (comic_id > 0) NOT NULL,
  creation timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)    ;
 
ALTER SEQUENCE reviews_seq RESTART WITH 6;

CREATE INDEX user_id ON reviews (user_id);
CREATE INDEX comic_id ON reviews (comic_id);

--
-- Dumping data for table `reviews`
--

INSERT INTO reviews (id, entry, user_id, comic_id, creation) VALUES
(1, 'If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 2, 3, '2012-11-15 10:41:44'),
(2, 'Donec quam tortor, vestibulum ut tincidunt in, congue sed lacus. Vestibulum a dolor sem. Pellentesque facilisis congue ante sed dapibus. Sed eleifend eleifend massa, ac adipiscing mauris dictum vel. Fusce non commodo ligula. Vivamus et nisl ac lectus facilisis iaculis nec non magna. Ut ultrices, augue sed dapibus hendrerit, libero leo pretium tellus, sit amet lobortis est velit non ipsum. Sed sollicitudin velit pharetra eros blandit vel sollicitudin purus feugiat.', 1, 3, '2012-11-15 10:42:23'),
(3, 'Fusce ultrices placerat magna, dignissim molestie nibh dictum sit amet. Nunc dapibus, arcu facilisis eleifend sodales, mi risus suscipit risus, vitae adipiscing velit dolor at sapien. Nunc commodo dolor ac eros commodo lacinia. Vestibulum sit amet dolor elit, eget interdum mi. In sed elit at dolor posuere faucibus sit amet ut eros. Aenean venenatis pulvinar libero, condimentum bibendum arcu ullamcorper eu.<br />rnPraesent mauris dui, porttitor id tempor at, <i>euismod sed odio. Nullam molestie, arcu sed rhoncus aliquet, nunc ante ullamcorper magna, eu adipiscing sapien nunc</i> ut odio. Vivamus viverra felis sit amet turpis ultricies vel volutpat orci dignissim. Praesent lobortis bibendum lorem sed gravida. Donec ac convallis libero. Aenean porta euismod orci, quis venenatis purus aliquet gravida. Ut nisi elit, interdum in mattis ac, varius non urna. Suspendisse quis eros velit. Aenean quam sapien, commodo a convallis sed, posuere id nisi. Suspendisse id mi nec purus molestie fringilla.', 10, 3, '2012-11-15 11:07:49'),
(4, 'Nunc ornare turpis purus. Pellentesque neque sapien, bibendum quis tempor non, sagittis a enim. Integer luctus sodales lacus, non semper leo placerat in. Aenean sit amet hendrerit mauris. In in dolor id libero bibendum rhoncus sit amet a risus. Vestibulum porttitor, urna in tincidunt aliquam, lacus felis viverra urna, euismod lobortis velit sapien eu tellus.<br />rn<br />rnDonec tincidunt convallis nibh, nec pharetra nisl suscipit ut. Praesent ornare, lorem in fermentum molestie, sem urna dictum lacus, id aliquet mauris turpis vitae nunc. Quisque vitae lobortis urna. Ut facilisis, urna non consectetur feugiat, nibh dolor euismod felis, eu commodo elit velit sit amet enim.', 10, 2, '2012-11-15 11:08:24'),
(5, 'Proin hendrerit, magna et suscipit tempor, nulla ipsum dapibus odio, vitae fermentum diam sapien at lorem. Suspendisse ipsum sapien, cursus nec luctus vel, condimentum sed mauris. Nullam rhoncus magna a lacus tempus faucibus. Pellentesque non nibh ligula. Donec laoreet orci justo, adipiscing faucibus risus. Nunc quis ipsum sem. Maecenas vestibulum tristique justo non laoreet. In vel lacus vitae felis imperdiet egestas at fermentum nunc. Aliquam sem quam, tristique et pulvinar vel, pharetra sit amet orci. In dictum pulvinar nulla, vitae ultrices mauris ultricies sit amet. In cursus dapibus rhoncus. Phasellus ut blandit dolor. Ut et neque augue. In hac habitasse platea dictumst. Integer dictum lectus a leo commodo eget euismod nibh eleifend. Proin sollicitudin pulvinar ipsum, ac porttitor magna varius pharetra.<br />rn<br />rnNunc odio neque, pellentesque eu molestie eu, varius sit amet neque. Sed facilisis tellus nec est consectetur tempus. Morbi ornare sem non urna hendrerit luctus. Nulla lectus erat, lacinia et egestas non, suscipit non sem. Curabitur sit amet ullamcorper leo. Ut tristique, lacus ac convallis porttitor, urna velit porttitor risus, et aliquam libero enim non ipsum. Proin eget quam eu velit condimentum vestibulum. Etiam lorem augue, rutrum ac fringilla nec, eleifend vel sapien. Morbi iaculis, lorem sed interdum elementum, lorem elit posuere mauris, ac placerat sem orci ut tortor. Nulla viverra tempus ante vel venenatis. Aenean convallis gravida nisl eu sollicitudin. In mi mi, scelerisque vel elementum a, posuere eu augue. Sed rutrum suscipit libero, vitae blandit purus lacinia vel. Quisque in iaculis eros. Donec sit amet rhoncus ante. Proin tempus dapibus purus, sit amet luctus nulla pellentesque vitae.', 3, 4, '2012-11-15 13:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE SEQUENCE users_seq;

CREATE TABLE IF NOT EXISTS users (
  id mediumint check (id > 0) NOT NULL DEFAULT NEXTVAL ('users_seq'),
  login varchar(30) NOT NULL,
  full_name varchar(100) NOT NULL,
  crypted_password varchar(200) NOT NULL,
  role varchar(20) NOT NULL DEFAULT 'user' ,
  creation timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)    ;
 
ALTER SEQUENCE users_seq RESTART WITH 11;

--
-- Dumping data for table `users`
--

INSERT INTO users (id, login, full_name, crypted_password, role, creation) VALUES
(1, 'matheus', 'Matheus Camargo', '$1$m.c5a7jH$JiJsMoS/qIeoKj2mexsfz/', 'admin', '2012-10-03 16:49:06'),
(2, 'amanda', 'Amanda Araujo', '$1$azEJFsJH$NySiK9Z/s1P3uwS4McF/G/', 'manager', '2012-10-10 06:33:54'),
(3, 'joao', 'Joao Pimentel', '$1$4DZJjPz6$ecGY5l9.JZLUisTvNE6x91', 'manager', '2012-10-10 06:34:14'),
(10, 'greg', 'Gregory Rowsey', '$1$WP..nd5.$HSq1p9VPnunuMkAnng3a.0', 'user', '2012-11-14 04:55:13');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `board_comments`
--
ALTER TABLE board_comments
  ADD CONSTRAINT board_comments_ibfk_2 FOREIGN KEY (topic_id) REFERENCES board_topics (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT board_comments_ibfk_1 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `board_topics`
--
ALTER TABLE board_topics
  ADD CONSTRAINT board_topics_ibfk_1 FOREIGN KEY (character_id) REFERENCES characters (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comic_ratings`
--
ALTER TABLE comic_ratings
  ADD CONSTRAINT comic_ratings_comic_id FOREIGN KEY (comic_id) REFERENCES comics (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT comic_ratings_user_id FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorite_characters`
--
ALTER TABLE favorite_characters
  ADD CONSTRAINT favorite_characters_ibfk_2 FOREIGN KEY (character_id) REFERENCES characters (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT favorite_characters_ibfk_1 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_feed`
--
ALTER TABLE news_feed
  ADD CONSTRAINT news_feed_ibfk_1 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE reviews
  ADD CONSTRAINT reviews_ibfk_4 FOREIGN KEY (comic_id) REFERENCES comics (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT reviews_ibfk_3 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE NO ACTION ON UPDATE NO ACTION;
