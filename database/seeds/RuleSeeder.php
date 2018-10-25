<?php

use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('rules')->insert([
        [
          'id' => 1,
          'name' => 'Nom d’équipe et nom de jeu',
          'description' => '<p>Chaque équipe choisit un nom et un nom pour son jeu. Ces noms ainsi que le contenu du jeu ne doivent pas être inappropriés (neutralité politique et religieuse, respect de l’individu), sous peine de disqualification.</p>',
        ],
        [
          'id' => 2,
          'name' => 'Le jeu',
          'description' => '<p>I. Le thème « événement aléatoires et rejouabilité » doit être respecté.</p>
        <ol>
          <li><p>Un événement aléatoire est un phénomène qui intervient à un moment incertain dans la partie (ex : apparition d’un personnage, d’un item etc.).</p></li>
          <li><p>La rejouabilité permet à l’utilisateur de ne pas vivre la même expérience lorsqu’il relance le jeu (ex : nouveaux objets, ennemis variables etc.).</p></li>
        </ol>
        <p>II. Le jeu doit être original et ne pas être la copie d’un jeu existant. <br/>
        III. Seuls le langage Ruby 2.4.2 et la bibliothèque Gosu sont autorisés. Aucune autre gem de Ruby n’est autorisée. <br/>
        IV. Le jeu doit comporter une section crédit comprenant les rôles de chaque membre de l’équipe ainsi que les différentes ressources extérieures utilisées. <br/>
        V. Le plagiat de tout ou partie du code d’un jeu existant entraînera la disqualification de l’équipe. </p>',
        ],
        [
          'id' => 3,
          'name' => 'Livrables à fournir',
          'description' => '<p>Chaque équipe doit impérativement fournir avant le jeudi 8 février 23h59 les éléments suivants :  Sur Youtube : </p>
        <ul>
          <li><p>Un trailer du jeu qui doit contenir des images du jeu et ne doit pas dépasser 1 minute 30.</p></li>
        </ul>
        <p>Sur le site de la Game Jam : </p>
        <ul>
          <li><p>Le lien vers le trailer.</p></li>
          <li><p>Une archive contenant l’intégralité du jeu (au format ZIP). </p></li>
          <li><p>Une jaquette du jeu carrée (image au format JPEG) qui fera office d’image de boîte de jeu. </p></li>
          <li><p>Une présentation du jeu (au format PDF) comportant sur la première diapositive un lien vers le trailer sur YouTube.</p></li>
        </ul>',
        ],
        [
          'id' => 4,
          'name' => 'Les délais à respecter',
          'description' => "<p>Doit être impérativement renseigné avant le Mercredi 7 Février à 23h59 :</p>
        <ul>
          <li><p>Une composition d'équipe définitive.</p></li>
          <li><p>Un nom d'équipe définitif.</p></li>
          <li><p>Le nom du jeu.</p></li>
        </ul>
        <br/>
        <p>Doit être impérativement saisi avant le Jeudi 8 Février 23h59 :</p>
        <ul>
          <li><p>Le lien vers le trailer.</p></li>
          <li><p>L'archive du jeu ZIP. </p></li>
          <li><p>La jaquette JPEG. </p></li>
          <li><p>La présentation PDF.</p></li>
        </ul>",
        ],
        [
          'id' => 5,
          'name' => 'La présentation',
          'description' => "<p>Les 25 équipes sont réparties en 5 poules. Le vendredi 8 février à 8h, chaque équipe présentera (en utilisant comme support la présentation PDF citée ci-dessus) et défendra dans sa poule sa réalisation devant un jury composé d’organisateurs et d’enseignants, sur un ordinateur personnel qu’elle apportera. <br/>
        Cette présentation doit être composée des éléments suivants : </p>
        <ul>
          <li><p>Présentation de l’équipe, du scénario du jeu ainsi que des choix. </p></li>
          <li><p>Trailer du jeu. </p></li>
          <li><p>Démonstration du jeu. </p></li>
        </ul>",
        ],[
          'id' => 6,
          'name' => 'La finale',
          'description' => "<p>Le jury de chaque poule attribuera un score (voir barème) à chaque équipe. L’équipe ayant le plus de points sera sélectionnée pour participer à la finale face aux vainqueurs des autres poules. Les équipes sélectionnées devront présenter leur jeu mais cette fois-ci le jury sera composé des enseignants, des organisateurs ainsi que des autres participants. Le vainqueur de la Game Jam sera l’équipe qui aura remporté le plus de voix.</p>",
        ],
      ]);
    }
}
