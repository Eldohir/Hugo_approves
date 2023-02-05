<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    const ARTICLES = [
        ['Name' => 'Final Fantasy IX', 'Date' => '07/07/2000', 'Summary' => 'Djidane et une princesse sont dans un bateau volant...', 'Category' => 'category_Final Fantasy', 'Image' => 'assets\images\FF9.png',],
        ['Name' => 'Final Fantasy VII', 'Date' => '31/07/1997', 'Summary' => 'Un schizophrène et ses amis au secours de la planète', 'Category' => 'category_Final Fantasy', 'Image' => 'assets\images\FF7.png',],
        ['Name' => 'Final Fantasy X', 'Date' => '19/07/2001', 'Summary' => 'Un blondinet dont le père se fâche tout rouge', 'Category' => 'category_Final Fantasy', 'Image' => 'assets\images\FF10.jpg',],
        ['Name' => 'Le Dictateur', 'Date' => "15/10/1940", 'Summary' => 'Notre Charlot préféré porte bien mal la moustache !', 'Category' => 'category_Films', 'Image' => 'assets\images\Dictateur.jpg',],
        ['Name' => 'Princesse Mononoke', 'Date' => "12/01/2000", 'Summary' => 'Une princesse qui n\'a besoin d\'être secourue par personne', 'Category' => 'category_Films', 'Image' => 'assets\images\mononoke.jpg',],
        ['Name' => 'Chantons sous la pluie', 'Date' => "23/12/1952", 'Summary' => 'Une bande de copaines qui donne de la voie et des claquettes', 'Category' => 'category_Films', 'Image' => 'assets\images\singing.jpg',],
        ['Name' => 'L\'écoféminisme de Françoise d\'Eaubonne', 'Date' => "Années 70", 'Summary' => 'Et la planète mise au féminin reverdirait pour tous!', 'Category' => 'category_Courants politiques', 'Image' => 'assets\images\ecofeminisme.jpg',],
        ['Name' => 'France 98', 'Date' => "12/07/1998", 'Summary' => 'Une France black blanc beurs', 'Category' => 'category_Grands moments de foot', 'Image' => 'assets\images\france98.jpg',],
        ['Name' => 'Messi montre son maillot', 'Date' => "23/04/2017", 'Summary' => 'Messi inscrit le but de la victoire face au Real dans les dernières secondes', 'Category' => 'category_Grands moments de foot', 'Image' => 'assets\images\messi.webp',],
        ['Name' => 'France Argentine 2022', 'Date' => "18/12/2022", 'Summary' => 'On s\'est fait voler !!!!!', 'Category' => 'category_Grands moments de foot', 'Image' => 'assets\images\FA2022.jpg',],
        ['Name' => 'Japon', 'Date' => "Décembre 2004", 'Summary' => 'Un jeune lycéen lâché dans Tokyo', 'Category' => 'category_Voyages', 'Image' => 'assets\images\japon.jpg',],
        ['Name' => 'Seven Wonders', 'Date' => "2010", 'Summary' => 'Le draft c\'est la vie !!!!', 'Category' => 'category_Jeux de société', 'Image' => 'assets\images\seven.png',],
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
