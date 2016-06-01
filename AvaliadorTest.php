<?php

  require 'Usuario.php';
  require 'Lance.php';
  require 'Leilao.php';
  require 'Avaliador.php';

  class AvaliadorTest extends PHPUnit_Framework_TestCase {
    public function testDeveAceitarLancesEmOrdemDecrecente() {
      $leilao = new Leilao("PlayStation 4");

      $renan = new Usuario("Renan");
      $caio = new Usuario("Caio");
      $felipe = new Usuario("Felipe");

      $leilao->propoe(new Lance($felipe, 400));
      $leilao->propoe(new Lance($renan, 350));
      $leilao->propoe(new Lance($caio, 200));

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $maiorEsperado = 400;
      $menorEsperado = 200;

      $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.00001);
      $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.00001);
    }

    public function testDeveAceitarLanceEmOrdemCrecente() {
      $leilao = new Leilao("PlayStation 4");

      $renan = new Usuario("Renan");
      $caio = new Usuario("Caio");
      $felipe = new Usuario("Felipe");

      $leilao->propoe(new Lance($felipe, 250));
      $leilao->propoe(new Lance($renan, 350));
      $leilao->propoe(new Lance($caio, 400));

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $maiorEsperado = 400;
      $menorEsperado = 250;

      $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.00001);
      $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.00001);
    }

    public function testCalcularAMedia() {
      $joao = new Usuario("Joao");
      $jose = new Usuario("José");
      $maria = new Usuario("Maria");

      $leilao = new Leilao("Playstation 3 Novo");

      $leilao->propoe(new Lance($maria,300.0));
      $leilao->propoe(new Lance($joao,850.0));
      $leilao->propoe(new Lance($jose,500.0));

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals(550, $leiloeiro->getMedia(), 0.0001);
    }

    public function testDeveAceitarApenasUmLance() {
      $maximiliano = new Usuario("Maximiliano");

      $leilao = new Leilao("Escort Hobby Ano 94");

      $leilao->propoe(new Lance($maximiliano, 4000));

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $maiorEsperado = 4000;
      $menorEsperado = 4000;

      $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.00001);
      $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.00001);
    }

    public function testDevePegarOsTresMaiores(){
      $leilao = new Leilao("Playstation 3 Novo");

      $renan = new Usuario("Renan");
      $mauricio = new Usuario("Mauricio");

      $leilao->propoe(new Lance($renan, 200));
      $leilao->propoe(new Lance($mauricio, 300));
      $leilao->propoe(new Lance($renan, 400));
      $leilao->propoe(new Lance($mauricio, 500));

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals(3, count($leiloeiro->getMaiores()));
      
      $this->assertEquals(500, $leiloeiro->getMaiores()[0]->getValor());
      $this->assertEquals(400, $leiloeiro->getMaiores()[1]->getValor());
      $this->assertEquals(300, $leiloeiro->getMaiores()[2]->getValor());
    }
  }
 ?>
