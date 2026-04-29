<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Medicament;
use PHPUnit\Framework\TestCase;

class MedicamentTest extends TestCase
{
    private Medicament $medicament;

    protected function setUp(): void
    {
        $this->medicament = new Medicament();
    }

    // ─── Initialisation ───────────────────────────────────────────────────────

    public function testIdIsNullOnCreation(): void
    {
        $this->assertNull($this->medicament->getId());
    }

    public function testNomIsNullOnCreation(): void
    {
        $this->assertNull($this->medicament->getNom());
    }

    public function testDciIsNullOnCreation(): void
    {
        $this->assertNull($this->medicament->getDci());
    }

    public function testFormeIsNullOnCreation(): void
    {
        $this->assertNull($this->medicament->getForme());
    }

    public function testDosageIsNullOnCreation(): void
    {
        $this->assertNull($this->medicament->getDosage());
    }

    // ─── Nom ──────────────────────────────────────────────────────────────────

    public function testSetNomReturnsStaticInstance(): void
    {
        $result = $this->medicament->setNom('Doliprane');

        $this->assertSame($this->medicament, $result);
    }

    public function testSetAndGetNom(): void
    {
        $this->medicament->setNom('Doliprane');

        $this->assertSame('Doliprane', $this->medicament->getNom());
    }

    public function testSetNomOverwritesPreviousValue(): void
    {
        $this->medicament->setNom('Doliprane');
        $this->medicament->setNom('Ibuprofène');

        $this->assertSame('Ibuprofène', $this->medicament->getNom());
    }

    // ─── Dci ──────────────────────────────────────────────────────────────────

    public function testSetDciReturnsStaticInstance(): void
    {
        $result = $this->medicament->setDci('Paracétamol');

        $this->assertSame($this->medicament, $result);
    }

    public function testSetAndGetDci(): void
    {
        $this->medicament->setDci('Paracétamol');

        $this->assertSame('Paracétamol', $this->medicament->getDci());
    }

    public function testSetDciOverwritesPreviousValue(): void
    {
        $this->medicament->setDci('Paracétamol');
        $this->medicament->setDci('Ibuprofène');

        $this->assertSame('Ibuprofène', $this->medicament->getDci());
    }

    // ─── Forme ────────────────────────────────────────────────────────────────

    public function testSetFormeReturnsStaticInstance(): void
    {
        $result = $this->medicament->setForme('Comprimé');

        $this->assertSame($this->medicament, $result);
    }

    public function testSetAndGetForme(): void
    {
        $this->medicament->setForme('Comprimé');

        $this->assertSame('Comprimé', $this->medicament->getForme());
    }

    public function testSetFormeOverwritesPreviousValue(): void
    {
        $this->medicament->setForme('Comprimé');
        $this->medicament->setForme('Sirop');

        $this->assertSame('Sirop', $this->medicament->getForme());
    }

    // ─── Dosage ───────────────────────────────────────────────────────────────

    public function testSetDosageReturnsStaticInstance(): void
    {
        $result = $this->medicament->setDosage('500mg');

        $this->assertSame($this->medicament, $result);
    }

    public function testSetAndGetDosage(): void
    {
        $this->medicament->setDosage('500mg');

        $this->assertSame('500mg', $this->medicament->getDosage());
    }

    public function testSetDosageOverwritesPreviousValue(): void
    {
        $this->medicament->setDosage('500mg');
        $this->medicament->setDosage('1000mg');

        $this->assertSame('1000mg', $this->medicament->getDosage());
    }
}