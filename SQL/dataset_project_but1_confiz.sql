INSERT INTO utilisateurs(id, username, password, email, role, prenom, nom, ddn) VALUES
(1, 'alice22', md5('1234'),  'alice22@example.com', 'admin', 'Alice', 'Dumoulin', '1982-11-26'),
(2, 'chalie', md5('1234'), 'chalie@example.com', 'gerant', 'Charlie', 'Elachocoleterie', '1977-01-12'),
(3, 'bobdu35', md5('1234'), 'bobdu35@example.com', 'client', 'Robert', 'Kinsey', '1982-10-12'),
(4, 'tywin', md5('1234'), 'tywin@example.com', 'client', 'Charles', 'Dance', '1946-10-10');

INSERT INTO `boutiques` (`id`, `nom`, `utilisateur_id`, `numero_rue`, `nom_adresse`, `code_postal`, `ville`, `pays`, `illustration`, `histoire`) VALUES
(1, 'La mika-line', 1, '10', 'Rue des Bonbons', '75001', 'Paris', 'France', 'img/img_bdd/B1', 'Au croisement du design contemporain et de l’héritage artisanal, la Mika Line incarne l’alliance parfaite entre modernité assumée et savoir-faire intemporel. Pensée comme une ode à la matière, à la forme et à la couleur, chaque pièce Mika est une déclaration de style, de caractère et d’authenticité.
Née d’une vision audacieuse portée par la Maison Bonpère, Mika s’adresse aux esprits libres, aux esthètes du quotidien, à celles et ceux qui voient dans chaque détail une manière d’exister pleinement. Derrière chaque création se cache une exigence, une quête presque obsessionnelle du juste équilibre entre lignes pures, textures franches et finitions impeccables.
Dans notre atelier, rien n’est laissé au hasard : des matériaux rigoureusement sélectionnés aux gestes précis de nos artisans, chaque étape célèbre l’excellence. La Mika Line ne suit pas les tendances, elle les inspire. Elle puise dans l’énergie brute des villes, le minimalisme du design nordique et l’élégance discrète des objets durables pour proposer des collections qui traversent le temps avec grâce.
Au-delà de l’objet, Mika est une expérience sensorielle. C’est la douceur d’une céramique mate sous les doigts, la fraîcheur d’un métal poli, le grain d’un cuir vieilli. C’est aussi une philosophie : celle de ralentir, de choisir mieux, de posséder moins mais mieux — et de s’entourer de beauté fonctionnelle.
Découvrez notre univers dans un espace pensé comme une galerie vivante, entre boutique et lieu d’inspiration. La Mika Line y déploie toute sa force silencieuse, et vous invite à redéfinir votre rapport aux objets, à la beauté et au quotidien.'),
(2, 'OK Bonbons', 2, '20', 'Avenue des Friandises', '69001', 'Lyon', 'France', 'img/img_bdd/B2', 'Bienvenue dans le monde coloré de OK Bonbon, un univers où la nostalgie flirte avec la fantaisie, et où chaque bouchée est une fête en soi. Ici, pas de chichis, juste du bon, du fun, et une bonne dose de souvenirs sucrés.
Créée par une bande de passionnés un peu rêveurs, un peu rebelles, OK Bonbon rend hommage à ces petits plaisirs qui font du bien sans raison. Car chez nous, le bonbon n’est pas un simple produit — c’est une émotion, un clin d’œil à l’enfance, un moment suspendu dans la course du quotidien.
Dans nos sachets vitaminés et nos boîtes au look rétro, vous trouverez une collection joyeusement éclectique : des bonbons qui piquent, qui fondent, qui croustillent ou qui éclatent en bouche. Des classiques revisités avec un brin d’impertinence, aux créations inédites imaginées dans notre atelier, chaque confiserie est conçue pour faire sourire, surprendre et réveiller les papilles.
OK Bonbon, c’est aussi un engagement sincère : des ingrédients de qualité, des arômes naturels quand c’est possible, des recettes sans superflu et un vrai respect des petits producteurs avec qui nous travaillons main dans la main. Parce qu’être fun n’empêche pas d’être responsable.
Nos boutiques, à mi-chemin entre la fête foraine et le concept-store acidulé, sont à notre image : généreuses, ludiques et un brin décalées. Que vous soyez collectionneur de bonheurs sucrés, adepte du grignotage régressif ou explorateur de nouvelles sensations, OK Bonbon est votre nouvelle adresse de la gourmandise joyeuse.
Entrez, piochez, croquez — et laissez-vous surprendre. Chez OK Bonbon, le plaisir est toujours une bonne idée.'),
(3, 'Saccharo', 3, '30', 'Boulevard des Saveurs', '13001', 'Marseille', 'France', 'img/img_bdd/B3', 'Saccharo n’est pas une simple maison de douceurs : c’est un laboratoire d’émotions sucrées, un théâtre des sens où l’art de la confiserie devient une exploration sensorielle. À la croisée des rituels anciens et des expériences nouvelles, Saccharo célèbre le sucre dans toute sa complexité, sa poésie, sa puissance évocatrice.
Née d’une volonté de réinventer les codes de la gourmandise, la marque puise son inspiration dans les apothicaires d’autrefois, les cabinets de curiosités et les grimoires oubliés, pour créer une collection rare de confiseries d’auteur. Ici, chaque bonbon est pensé comme une formule, un équilibre délicat entre saveurs, textures et émotions.
Nos créations — pastilles infusées aux herbes rares, cristaux de sucre parfumés, caramels infusés aux épices, perles acidulées — sont conçues dans notre atelier-laboratoire, où s’entrelacent précision scientifique et intuition créative. Tout est fait à la main, lentement, avec une attention presque alchimique portée aux matières premières, aux températures, aux couleurs et aux temps de repos.
Chez Saccharo, le sucre ne masque rien. Il révèle. Il sublime des ingrédients nobles, inattendus, souvent oubliés, et les transforme en récits comestibles. Déguster une création Saccharo, c’est plonger dans une mémoire, une sensation, un ailleurs.
Nos écrins noirs et or, sobres et énigmatiques, abritent ces trésors sucrés comme on conserve un secret précieux. Notre boutique, elle, est un lieu de silence et d’émerveillement, pensée comme une parenthèse hors du monde, où chaque visiteur est invité à ralentir, à goûter, à ressentir.
Saccharo est une invitation à repenser le plaisir, à le vivre comme un art, un instant de conscience, un rituel délicat. Ici, la douceur devient une philosophie.');

INSERT INTO `confiseries` (`id`, `nom`, `type`, `prix`, `illustration`, `description`) VALUES
(1, 'Bonbon Acide', 'Acide', 1.99, '', 'Bonbon acide délicieux'),
(2, 'Caramel', 'Douceur', 2.49, '', 'Caramel fondant au beurre salé'),
(3, 'Chocolat Noir', 'Chocolat', 3.99, '', 'Chocolat noir à 70% de cacao'),
(4, 'Dragée', 'Fête', 4.99, '', 'Dragées pour les mariages et baptêmes'),
(5, 'Sucette', 'Classique', 1.50, '', 'Sucette aux fruits rouges'),
(6, 'Nougat', 'Douceur', 2.99, '', 'Nougat tendre avec des amandes'),
(7, 'Gomme', 'Fruité', 1.75, '', 'Gommes aux fruits assortis'),
(8, 'Réglisse', 'Classique', 1.89, '', 'Bonbon à la réglisse'),
(9, 'Praline', 'Gourmandise', 5.49, '', 'Praline enrobée de chocolat'),
(10, 'Menthe', 'Frais', 1.20, '', 'Bonbon à la menthe rafraîchissante'),
(11, 'Bonbon Acidulé', 'Acide', 2.30, '', 'Bonbon acidulé aux agrumes'),
(12, 'Fudge', 'Douceur', 3.50, '', 'Fudge crémeux au chocolat'),
(13, 'Chocolat au Lait', 'Chocolat', 2.99, '', 'Chocolat au lait onctueux'),
(14, 'Guimauve', 'Fête', 3.00, '', 'Guimauve moelleuse'),
(15, 'Sucette Tournante', 'Classique', 2.00, '', 'Sucette tournante multicolore'),
(16, 'Pâte de Fruits', 'Fruité', 4.00, '', 'Pâte de fruits à la framboise'),
(17, 'Bonbon Fourré', 'Gourmandise', 3.20, '', 'Bonbon fourré au caramel'),
(18, 'Gomme Arlequin', 'Classique', 2.50, '', 'Gomme multicolore'),
(19, 'Caramel au Beurre', 'Douceur', 1.99, '', 'Caramel fondant au beurre doux'),
(20, 'Chocolat Blanc', 'Chocolat', 4.49, '', 'Chocolat blanc vanillé'),
(21, 'Bonbon Miel', 'Frais', 1.80, '', 'Bonbon au miel de montagne'),
(22, 'Nougatine', 'Gourmandise', 3.75, '', 'Nougatine croustillante'),
(23, 'Menthe Forte', 'Frais', 1.50, '', 'Bonbon à la menthe forte'),
(24, 'Bonbon Gélifié', 'Fruité', 2.20, '', 'Bonbon gélifié aux fruits tropicaux'),
(25, 'Caramel Dur', 'Classique', 1.60, '', 'Caramel dur et croquant'),
(26, 'Chocolat Praliné', 'Chocolat', 3.80, '', 'Chocolat praliné noisette'),
(27, 'Bonbon à l\'Orange', 'Fruité', 1.99, '', 'Bonbon à l\'orange acidulé'),
(28, 'Réglisse Douce', 'Classique', 1.70, '', 'Réglisse douce et sucrée'),
(29, 'Caramel Mou', 'Douceur', 2.10, '', 'Caramel mou et tendre'),
(30, 'Chocolat Noir Intense', 'Chocolat', 5.00, '', 'Chocolat noir intense 85% de cacao'),
(31, 'Sucette Fruitée', 'Classique', 1.75, '', 'Sucette fruitée assortie'),
(32, 'Dragée au Chocolat', 'Fête', 3.99, '', 'Dragée au chocolat pour les fêtes'),
(33, 'Nougat Blanc', 'Douceur', 3.25, '', 'Nougat blanc avec des pistaches'),
(34, 'Gomme Fruitée', 'Fruité', 2.50, '', 'Gomme fruitée mixte'),
(35, 'Bonbon à la Fraise', 'Fruité', 1.90, '', 'Bonbon à la fraise sucrée'),
(36, 'Caramel au Sel', 'Douceur', 2.75, '', 'Caramel au beurre salé'),
(37, 'Chocolat au Noisette', 'Chocolat', 4.00, '', 'Chocolat au lait avec des noisettes entières'),
(38, 'Bonbon à la Menthe', 'Frais', 1.50, '', 'Bonbon à la menthe rafraîchissante'),
(39, 'Pâte à Sucre', 'Classique', 2.30, '', 'Pâte à sucre colorée'),
(40, 'Caramel Croquant', 'Douceur', 2.99, '', 'Caramel croquant au beurre'),
(41, 'Guimauve Fruitée', 'Fête', 2.80, '', 'Guimauve fruitée assortie'),
(42, 'Chocolat Fondant', 'Chocolat', 3.75, '', 'Chocolat fondant au lait'),
(43, 'Bonbon Réglisse', 'Classique', 1.99, '', 'Bonbon à la réglisse pure'),
(44, 'Dragée Sucrée', 'Fête', 4.50, '', 'Dragée sucrée colorée'),
(45, 'Nougat Noir', 'Douceur', 3.50, '', 'Nougat noir au miel'),
(46, 'Gomme à la Menthe', 'Frais', 1.70, '', 'Gomme à la menthe verte'),
(47, 'Caramel au Chocolat', 'Douceur', 2.20, '', 'Caramel enrobé de chocolat'),
(48, 'Bonbon Pétillant', 'Classique', 2.00, '', 'Bonbon pétillant en bouche'),
(49, 'Chocolat Blanc Fraise', 'Chocolat', 4.20, '', 'Chocolat blanc à la fraise'),
(50, 'Sucette à la Cerise', 'Classique', 1.50, '', 'Sucette à la cerise acidulée');


INSERT INTO stocks(quantite, date_de_modification, boutique_id, confiserie_id) VALUES
(24, NOW(), 1, 1),
(54, NOW(), 1, 4),
(17, NOW(), 2, 6),
(120, NOW(), 2, 7),
(8, NOW(), 2, 10);