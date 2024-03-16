<?php 
class Ponto {
    private $x;
    private $y;
    private static $contador = 0;

    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
        self::$contador++;
    }

    public static function contarPontos() {
        return self::$contador;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function getX() {
        return $this->x;
    }

    public function setY($y) {
        $this->y = $y;
    }

    public function getY() {
        return $this->y;
    }

    public function deslocar($dx, $dy) {
        $this->x += $dx;
        $this->y += $dy;
    }

    public function toString() {
        return "($this->x, $this->y)";
    }

    public function distanciaParaPonto(Ponto $ponto) {
        $distX = $this->x - $ponto->getX();
        $distY = $this->y - $ponto->getY();
        return sqrt($distX ** 2 + $distY ** 2);
    }

    public function distanciaParaCoordenadas($x, $y) {
        $distX = $this->x - $x;
        $distY = $this->y - $y;
        return sqrt($distX ** 2 + $distY ** 2);
    }

    public static function distanciaEntrePontos($x1, $y1, $x2, $y2) {
        $distX = $x1 - $x2;
        $distY = $y1 - $y2;
        return sqrt($distX ** 2 + $distY ** 2);
    }
}

$ponto1 = new Ponto(0, 0);
$ponto2 = new Ponto(3, 4);

echo "Distância entre ponto1 e ponto2: " . $ponto1->distanciaParaPonto($ponto2) . "\n";
echo "Distância entre ponto1 e (3, 4): " . $ponto1->distanciaParaCoordenadas(3, 4) . "\n";
echo "Distância entre (0, 0) e (3, 4): " . Ponto::distanciaEntrePontos(0, 0, 3, 4) . "\n";
echo "Número de pontos criados: " . Ponto::contarPontos() . "\n";