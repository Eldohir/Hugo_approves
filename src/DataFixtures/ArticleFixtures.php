<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    const ARTICLES = [
        ['Name' => 'Final Fantasy IX', 'Date' => '07/07/2000', 'Summary' => 'Djidane et une princesse sont dans un bateau volant...', 'Category' => 'category_Final Fantasy', 'Image' => 'https://upload.wikimedia.org/wikipedia/en/5/51/Ffixbox.jpg',],
        ['Name' => 'Final Fantasy VII', 'Date' => '31/07/1997', 'Summary' => 'Un schizophrène et ses amis au secours de la planète', 'Category' => 'category_Final Fantasy', 'Image' => 'https://new-game-plus.fr/wp-content/uploads/2021/02/Final-Fantasy-VII-casting.jpg',],
        ['Name' => 'Final Fantasy X', 'Date' => '19/07/2001', 'Summary' => 'Un blondinet dont le père se fâche tout rouge', 'Category' => 'category_Final Fantasy', 'Image' => 'https://assets-prd.ignimgs.com/2021/12/20/ffx-art-1640032077055.jpg',],
        ['Name' => 'Le Dictateur', 'Date' => "15/10/1940", 'Summary' => 'Notre Charlot préféré porte bien mal la moustache !', 'Category' => 'category_Films', 'Image' => 'https://www.cinema-histoire-pessac.com/sites/default/files/2018-10/Le%20dictateur.jpg',],
        ['Name' => 'Princesse Mononoke', 'Date' => "12/01/2000", 'Summary' => 'Une princesse qui n\'a besoin d\'être secourue par personne', 'Category' => 'category_Films', 'Image' => 'https://fr.web.img2.acsta.net/pictures/21/02/09/12/46/1884055.jpg',],
        ['Name' => 'Chantons sous la pluie', 'Date' => "23/12/1952", 'Summary' => 'Une bande de copaines qui donne de la voie et des claquettes', 'Category' => 'category_Films', 'Image' => 'https://jevaisciner.fr/wp/wp-content/uploads/jvc_posters/Chantons%20Sous%20La%20Pluie%20Poster.jpg',],
        ['Name' => 'L\'écoféminisme de Françoise d\'Eaubonne', 'Date' => "Années 70", 'Summary' => 'Et la planète mise au féminin reverdirait pour tous!', 'Category' => 'category_Courants politiques', 'Image' => 'https://www.wakatsera.com/wp-content/uploads/2020/03/ecofeminisme.jpg',],
        ['Name' => 'France 98', 'Date' => "12/07/1998", 'Summary' => 'Une France black blanc beurs', 'Category' => 'category_Grands moments de foot', 'Image' => 'https://imgr.foot11.com/2022/07/Icon_pxl_200612_08_15.jpg',],
        ['Name' => 'Messi montre son maillot', 'Date' => "23/04/2017", 'Summary' => 'Messi inscrit le but de la victoire face au Real dans les dernières secondes', 'Category' => 'category_Grands moments de foot', 'Image' => 'https://imgresizer.eurosport.com/unsafe/1280x960/smart/filters:format(jpeg)/origin-imgresizer.eurosport.com/2017/04/23/2069027-43375747-2560-1440.jpg',],
        ['Name' => 'France Argentine 2022', 'Date' => "18/12/2022", 'Summary' => 'On s\'est fait voler !!!!!', 'Category' => 'category_Grands moments de foot', 'Image' => 'https://images.bfmtv.com/coiku1jV0hQp8OYSWB07sVg-upk=/0x0:2048x1365/600x0/images/Kylian-Mbappe-abattu-sur-le-banc-apres-France-Argentine-finale-de-la-Coupe-du-monde-2022-1542902.jpg',],
        ['Name' => 'Japon', 'Date' => "Décembre 2004", 'Summary' => 'Un jeune lycéen lâché dans Tokyo', 'Category' => 'category_Voyages', 'Image' => 'https://www.vinsetgastronomie.com/wp-content/uploads/2017/04/le-japon.jpg',],
        ['Name' => 'Seven Wonders', 'Date' => "2010", 'Summary' => 'Le draft c\'est la vie !!!!', 'Category' => 'category_Jeux de société', 'Image' => 'https://cdn2.philibertnet.com/478487-thickbox_default/7-wonders-nouvelle-edition.jpg',],
    ];

    public function load(ObjectManager $manager)
    {
        $number = 0;

        foreach (self::ARTICLES as $blog) {
            $article = new Article();
            $article->setName($blog['Name']);
            $article->setDate($blog['Date']);
            $article->setSummary($blog['Summary']);
            $article->setCategory($this->getReference($blog['Category']));
            $article->setImage($blog['Image']);
            $manager->persist($article);
            $this->addReference('article' . $number += 1, $article);

            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
