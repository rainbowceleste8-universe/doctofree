<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Medicament;
use App\Entity\Ordonnance;
use App\Entity\Prescription;
use PHPUnit\Framework\TestCase;

class PrescriptionTest extends TestCase
{
    private Prescription $prescription;

    protected function setUp(): void
    {
        $this->prescription = new Prescription();
    }

    // ─── Initialisation ───────────────────────────────────────────────────────

    public function testIdIsNullOnCreation(): void
    {
        $this->assertNull($this->prescription->getId());
    }

    public function testPosologieIsNullOnCreation(): void
    {
        $this->assertNull($this->prescription->getPosologie());
    }

    public function testDureeJoursIsNullOnCreation(): void
    {
        $this->assertNull($this->prescription->getDureeJours());
    }

    public function testFrequenceIsNullOnCreation(): void
    {
        $this->assertNull($this->prescription->getFrequence());
    }

    public function testOrdonnanceIsNullOnCreation(): void
    {
        $this->assertNull($this->prescription->getOrdonnance());
    }

    public function testMedicamentIsNullOnCreation(): void
    {
        $this->assertNull($this->prescription->getMedicament());
    }

    // ─── Posologie ────────────────────────────────────────────────────────────

    public function testSetPosologieReturnsStaticInstance(): void
    {
        $result = $this->prescription->setPosologie('1 comprimé matin et soir');

        $this->assertSame($this->prescription, $result);
    }

    public function testSetAndGetPosologie(): void
    {
        $this->prescription->setPosologie('1 comprimé matin et soir');

        $this->assertSame('1 comprimé matin et soir', $this->prescription->getPosologie());
    }

    public function testSetPosologieOverwritesPreviousValue(): void
    {
        $this->prescription->setPosologie('1 comprimé matin et soir');
        $this->prescription->setPosologie('2 comprimés le midi');

        $this->assertSame('2 comprimés le midi', $this->prescription->getPosologie());
    }

    // ─── DureeJours ───────────────────────────────────────────────────────────

    public function testSetDureeJoursReturnsStaticInstance(): void
    {
        $result = $this->prescription->setDureeJours(7);

        $this->assertSame($this->prescription, $result);
    }

    public function testSetAndGetDureeJours(): void
    {
        $this->prescription->setDureeJours(7);

        $this->assertSame(7, $this->prescription->getDureeJours());
    }

    public function testSetDureeJoursOverwritesPreviousValue(): void
    {
        $this->prescription->setDureeJours(7);
        $this->prescription->setDureeJours(14);

        $this->assertSame(14, $this->prescription->getDureeJours());
    }

    // ─── Frequence ────────────────────────────────────────────────────────────

    public function testSetFrequenceReturnsStaticInstance(): void
    {
        $result = $this->prescription->setFrequence('Deux fois par jour');

        $this->assertSame($this->prescription, $result);
    }

    public function testSetAndGetFrequence(): void
    {
        $this->prescription->setFrequence('Deux fois par jour');

        $this->assertSame('Deux fois par jour', $this->prescription->getFrequence());
    }

    public function testSetFrequenceOverwritesPreviousValue(): void
    {
        $this->prescription->setFrequence('Deux fois par jour');
        $this->prescription->setFrequence('Une fois par semaine');

        $this->assertSame('Une fois par semaine', $this->prescription->getFrequence());
    }

    // ─── Ordonnance ───────────────────────────────────────────────────────────

    public function testSetOrdonnanceReturnsStaticInstance(): void
    {
        $ordonnance = $this->createStub(Ordonnance::class);
        $result = $this->prescription->setOrdonnance($ordonnance);

        $this->assertSame($this->prescription, $result);
    }

    public function testSetAndGetOrdonnance(): void
    {
        $ordonnance = $this->createStub(Ordonnance::class);
        $this->prescription->setOrdonnance($ordonnance);

        $this->assertSame($ordonnance, $this->prescription->getOrdonnance());
    }

    public function testSetOrdonnanceAcceptsNull(): void
    {
        $ordonnance = $this->createStub(Ordonnance::class);

        $this->prescription->setOrdonnance($ordonnance);
        $this->prescription->setOrdonnance(null);

        $this->assertNull($this->prescription->getOrdonnance());
    }

    // ─── Medicament ───────────────────────────────────────────────────────────

    public function testSetMedicamentReturnsStaticInstance(): void
    {
        $medicament = $this->createStub(Medicament::class);
        $result = $this->prescription->setMedicament($medicament);

        $this->assertSame($this->prescription, $result);
    }

    public function testSetAndGetMedicament(): void
    {
        $medicament = $this->createStub(Medicament::class);
        $this->prescription->setMedicament($medicament);

        $this->assertSame($medicament, $this->prescription->getMedicament());
    }

    public function testSetMedicamentAcceptsNull(): void
    {
        $medicament = $this->createStub(Medicament::class);

        $this->prescription->setMedicament($medicament);
        $this->prescription->setMedicament(null);

        $this->assertNull($this->prescription->getMedicament());
    }
}