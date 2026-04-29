<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Medecin;
use App\Entity\Specialite;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class SpecialiteTest extends TestCase
{
    private Specialite $specialite;

    protected function setUp(): void
    {
        $this->specialite = new Specialite();
    }

    // ─── Initialisation ───────────────────────────────────────────────────────

    public function testIdIsNullOnCreation(): void
    {
        $this->assertNull($this->specialite->getId());
    }

    public function testLibelleIsNullOnCreation(): void
    {
        $this->assertNull($this->specialite->getLibelle());
    }

    public function testDescriptionIsNullOnCreation(): void
    {
        $this->assertNull($this->specialite->getDescription());
    }

    public function testMedecinsIsEmptyCollectionOnCreation(): void
    {
        $medecins = $this->specialite->getMedecins();

        $this->assertInstanceOf(Collection::class, $medecins);
        $this->assertCount(0, $medecins);
    }

    // ─── Libelle ──────────────────────────────────────────────────────────────

    public function testSetLibelleReturnsStaticInstance(): void
    {
        $result = $this->specialite->setLibelle('Cardiologie');

        $this->assertSame($this->specialite, $result);
    }

    public function testSetAndGetLibelle(): void
    {
        $this->specialite->setLibelle('Cardiologie');

        $this->assertSame('Cardiologie', $this->specialite->getLibelle());
    }

    public function testSetLibelleOverwritesPreviousValue(): void
    {
        $this->specialite->setLibelle('Cardiologie');
        $this->specialite->setLibelle('Neurologie');

        $this->assertSame('Neurologie', $this->specialite->getLibelle());
    }

    // ─── Description ─────────────────────────────────────────────────────────

    public function testSetDescriptionReturnsStaticInstance(): void
    {
        $result = $this->specialite->setDescription('Maladies du cœur');

        $this->assertSame($this->specialite, $result);
    }

    public function testSetAndGetDescription(): void
    {
        $this->specialite->setDescription('Maladies du cœur');

        $this->assertSame('Maladies du cœur', $this->specialite->getDescription());
    }

    public function testSetDescriptionAcceptsNull(): void
    {
        $this->specialite->setDescription('Maladies du cœur');
        $this->specialite->setDescription(null);

        $this->assertNull($this->specialite->getDescription());
    }

    // ─── addMedecin ───────────────────────────────────────────────────────────

    public function testAddMedecinIncreasesCount(): void
    {
        $medecin = $this->createStub(Medecin::class);
        $medecin->method('addSpecialite')->willReturn($medecin);

        $this->specialite->addMedecin($medecin);

        $this->assertCount(1, $this->specialite->getMedecins());
    }

    public function testAddMedecinReturnsStaticInstance(): void
    {
        $medecin = $this->createStub(Medecin::class);
        $medecin->method('addSpecialite')->willReturn($medecin);

        $result = $this->specialite->addMedecin($medecin);

        $this->assertSame($this->specialite, $result);
    }

    public function testAddMedecinDoesNotAddDuplicate(): void
    {
        $medecin = $this->createStub(Medecin::class);
        $medecin->method('addSpecialite')->willReturn($medecin);

        $this->specialite->addMedecin($medecin);
        $this->specialite->addMedecin($medecin);

        $this->assertCount(1, $this->specialite->getMedecins());
    }

    public function testAddMedecinCallsAddSpecialiteOnMedecin(): void
    {
        $medecin = $this->createMock(Medecin::class);
        $medecin->expects($this->once())
            ->method('addSpecialite')
            ->with($this->specialite);

        $this->specialite->addMedecin($medecin);
    }

    public function testAddMedecinDoesNotCallAddSpecialiteOnDuplicate(): void
    {
        $medecin = $this->createMock(Medecin::class);
        $medecin->method('addSpecialite')->willReturn($medecin);

        $this->specialite->addMedecin($medecin);

        // Le deuxième appel ne doit pas déclencher addSpecialite
        $medecin->expects($this->never())->method('addSpecialite');
        $this->specialite->addMedecin($medecin);
    }

    // ─── removeMedecin ────────────────────────────────────────────────────────

    public function testRemoveMedecinDecreasesCount(): void
    {
        $medecin = $this->createStub(Medecin::class);
        $medecin->method('addSpecialite')->willReturn($medecin);
        $medecin->method('removeSpecialite')->willReturn($medecin);

        $this->specialite->addMedecin($medecin);
        $this->specialite->removeMedecin($medecin);

        $this->assertCount(0, $this->specialite->getMedecins());
    }

    public function testRemoveMedecinReturnsStaticInstance(): void
    {
        $medecin = $this->createStub(Medecin::class);
        $medecin->method('addSpecialite')->willReturn($medecin);
        $medecin->method('removeSpecialite')->willReturn($medecin);

        $this->specialite->addMedecin($medecin);
        $result = $this->specialite->removeMedecin($medecin);

        $this->assertSame($this->specialite, $result);
    }

    public function testRemoveMedecinCallsRemoveSpecialiteOnMedecin(): void
    {
        $medecin = $this->createMock(Medecin::class);
        $medecin->method('addSpecialite')->willReturn($medecin);
        $medecin->expects($this->once())->method('removeSpecialite')->with($this->specialite);

        $this->specialite->addMedecin($medecin);
        $this->specialite->removeMedecin($medecin);
    }

    public function testRemoveMedecinNotInCollectionDoesNothing(): void
    {
        $medecin = $this->createMock(Medecin::class);
        $medecin->method('removeSpecialite')->willReturn($medecin);

        // removeSpecialite ne doit pas être appelé si le médecin n'est pas dans la liste
        $medecin->expects($this->never())->method('removeSpecialite');

        $this->specialite->removeMedecin($medecin);
        $this->assertCount(0, $this->specialite->getMedecins());
    }

    // ─── __toString ───────────────────────────────────────────────────────────

    public function testToStringReturnsLibelle(): void
    {
        $this->specialite->setLibelle('Dermatologie');

        $this->assertSame('Dermatologie', (string) $this->specialite);
    }
}