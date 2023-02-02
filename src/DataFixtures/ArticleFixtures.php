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
        ['Name' => 'Le Dictateur', 'Date' => "15/10/1940", 'Summary' => 'Notre Charlot préféré porte bien mal la moustache !', 'Category' => 'category_Films', 'Image' => 'assets\images\Dictateur.jpg',],
        ['Name' => 'L\'écoféminisme de Françoise d\'Eaubonne', 'Date' => "Années 70", 'Summary' => 'Et la planète mise au féminin reverdirait pour tous!', 'Category' => 'category_Courants politiques', 'Image' => 'assets\images\ecofeminisme.jpg',],
        ['Name' => 'France 98', 'Date' => "12/07/1998", 'Summary' => 'Une France black blanc beurs', 'Category' => 'category_Grands moments de foot', 'Image' => 'assets\images\france98.jpg',],
        ['Name' => 'Japon', 'Date' => "Décembre 2004", 'Summary' => 'Un jeune lycéen lâché dans Tokyo', 'Category' => 'category_Voyages', 'Image' => 'assets\images\japon.jpg',],
        ['Name' => 'Seven Wonders', 'Date' => "2010", 'Summary' => 'Le draft c\'est la vie !!!!', 'Category' => 'category_Jeux de société', 'Image' => 'assets\images\seven.png',],
    ];

    public function load(ObjectManager $manager)
    {
        $number = 0;

        foreach (self::ARTICLES as $article) {
            $article = new Article();
            $article->setName($article['Name']);
            $article->setDate($article['Date']);
            $article->setSummary($article['Summary']);
            $article->setCategory($this->getReference($article['Category']));
            $article->setImage($article['Image']);
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
