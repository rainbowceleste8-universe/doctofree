<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Cabinet;
use App\Entity\Medecin;
use App\Entity\Rendezvous;
use App\Entity\Specialite;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class MedecinTest extends TestCase
{
    private Medecin $medecin;

    protected function setUp(): void
    {
        $this->medecin = new Medecin();
    }

    // ─── Initialisation ───────────────────────────────────────────────────────

    public function testIdIsNullOnCreation(): void
    {
        $this->assertNull($this->medecin->getId());
    }

    public function testNomIsNullOnCreation(): void
    {
        $this->assertNull($this->medecin->getNom());
    }

    public function testPrenomIsNullOnCreation(): void
    {
        $this->assertNull($this->medecin->getPrenom());
    }

    public function testRppsIsNullOnCreation(): void
    {
        $this->assertNull($this->medecin->getRpps());
    }

    public function testTelephoneIsNullOnCreation(): void
    {
        $this->assertNull($this->medecin->getTelephone());
    }

    public function testEmailIsNullOnCreation(): void
    {
        $this->assertNull($this->medecin->getEmail());
    }

    public function testListeRendezVousIsEmptyCollectionOnCreation(): void
    {
        $collection = $this->medecin->getListeRendezVous();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(0, $collection);
    }

    public function testCabinetsIsEmptyCollectionOnCreation(): void
    {
        $collection = $this->medecin->getCabinets();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(0, $collection);
    }

    public function testSpecialitesIsEmptyCollectionOnCreation(): void
    {
        $collection = $this->medecin->getSpecialites();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(0, $collection);
    }

    // ─── Nom ──────────────────────────────────────────────────────────────────

    public function testSetNomReturnsStaticInstance(): void
    {
        $result = $this->medecin->setNom('Dupont');

        $this->assertSame($this->medecin, $result);
    }

    public function testSetAndGetNom(): void
    {
        $this->medecin->setNom('Dupont');

        $this->assertSame('Dupont', $this->medecin->getNom());
    }

    public function testSetNomOverwritesPreviousValue(): void
    {
        $this->medecin->setNom('Dupont');
        $this->medecin->setNom('Martin');

        $this->assertSame('Martin', $this->medecin->getNom());
    }

    // ─── Prenom ───────────────────────────────────────────────────────────────

    public function testSetPrenomReturnsStaticInstance(): void
    {
        $result = $this->medecin->setPrenom('Jean');

        $this->assertSame($this->medecin, $result);
    }

    public function testSetAndGetPrenom(): void
    {
        $this->medecin->setPrenom('Jean');

        $this->assertSame('Jean', $this->medecin->getPrenom());
    }

    // ─── Rpps ─────────────────────────────────────────────────────────────────

    public function testSetRppsReturnsStaticInstance(): void
    {
        $result = $this->medecin->setRpps('12345678901');

        $this->assertSame($this->medecin, $result);
    }

    public function testSetAndGetRpps(): void
    {
        $this->medecin->setRpps('12345678901');

        $this->assertSame('12345678901', $this->medecin->getRpps());
    }

    // ─── Telephone ────────────────────────────────────────────────────────────

    public function testSetTelephoneReturnsStaticInstance(): void
    {
        $result = $this->medecin->setTelephone('0601020304');

        $this->assertSame($this->medecin, $result);
    }

    public function testSetAndGetTelephone(): void
    {
        $this->medecin->setTelephone('0601020304');

        $this->assertSame('0601020304', $this->medecin->getTelephone());
    }

    // ─── Email ────────────────────────────────────────────────────────────────

    public function testSetEmailReturnsStaticInstance(): void
    {
        $result = $this->medecin->setEmail('jean.dupont@exemple.fr');

        $this->assertSame($this->medecin, $result);
    }

    public function testSetAndGetEmail(): void
    {
        $this->medecin->setEmail('jean.dupont@exemple.fr');

        $this->assertSame('jean.dupont@exemple.fr', $this->medecin->getEmail());
    }

    // ─── RendezVous ───────────────────────────────────────────────────────────

    public function testAddListeRendezVouIncreasesCount(): void
    {
        $rdv = $this->createStub(Rendezvous::class);
        $rdv->method('setMedecin')->willReturn($rdv);

        $this->medecin->addListeRendezVou($rdv);

        $this->assertCount(1, $this->medecin->getListeRendezVous());
    }

    public function testAddListeRendezVouReturnsStaticInstance(): void
    {
        $rdv = $this->createStub(Rendezvous::class);
        $rdv->method('setMedecin')->willReturn($rdv);

        $result = $this->medecin->addListeRendezVou($rdv);

        $this->assertSame($this->medecin, $result);
    }

    public function testAddListeRendezVouDoesNotAddDuplicate(): void
    {
        $rdv = $this->createStub(Rendezvous::class);
        $rdv->method('setMedecin')->willReturn($rdv);

        $this->medecin->addListeRendezVou($rdv);
        $this->medecin->addListeRendezVou($rdv);

        $this->assertCount(1, $this->medecin->getListeRendezVous());
    }

    public function testAddListeRendezVouCallsSetMedecinOnRdv(): void
    {
        $rdv = $this->createMock(Rendezvous::class);
        $rdv->expects($this->once())
            ->method('setMedecin')
            ->with($this->medecin);

        $this->medecin->addListeRendezVou($rdv);
    }

    public function testRemoveListeRendezVouDecreasesCount(): void
    {
        $rdv = $this->createStub(Rendezvous::class);
        $rdv->method('setMedecin')->willReturn($rdv);
        $rdv->method('getMedecin')->willReturn($this->medecin);

        $this->medecin->addListeRendezVou($rdv);
        $this->medecin->removeListeRendezVou($rdv);

        $this->assertCount(0, $this->medecin->getListeRendezVous());
    }

    public function testRemoveListeRendezVouReturnsStaticInstance(): void
    {
        $rdv = $this->createStub(Rendezvous::class);
        $rdv->method('setMedecin')->willReturn($rdv);
        $rdv->method('getMedecin')->willReturn($this->medecin);

        $this->medecin->addListeRendezVou($rdv);
        $result = $this->medecin->removeListeRendezVou($rdv);

        $this->assertSame($this->medecin, $result);
    }

    public function testRemoveListeRendezVouSetsNullWhenOwnerMatches(): void
    {
        // Un vrai Rendezvous pour que setMedecin() lors du add ne soit pas intercepté
        $rdv = new Rendezvous();

        $this->medecin->addListeRendezVou($rdv);

        // Après le add, le médecin du RDV est bien $this->medecin
        $this->assertSame($this->medecin, $rdv->getMedecin());

        $this->medecin->removeListeRendezVou($rdv);

        // Après le remove, le médecin est mis à null
        $this->assertNull($rdv->getMedecin());
    }

    public function testRemoveListeRendezVouDoesNotSetNullWhenOwnerChanged(): void
    {
        $autreMedecin = new Medecin();
        $rdv = new Rendezvous();

        $this->medecin->addListeRendezVou($rdv);

        // On simule un changement de propriétaire côté owning
        $rdv->setMedecin($autreMedecin);

        $this->medecin->removeListeRendezVou($rdv);

        // Le médecin du RDV ne doit pas avoir été remis à null
        $this->assertSame($autreMedecin, $rdv->getMedecin());
    }

    // ─── Cabinets ─────────────────────────────────────────────────────────────

    public function testAddCabinetIncreasesCount(): void
    {
        $cabinet = $this->createStub(Cabinet::class);
        $cabinet->method('addMedecin')->willReturn($cabinet);

        $this->medecin->addCabinet($cabinet);

        $this->assertCount(1, $this->medecin->getCabinets());
    }

    public function testAddCabinetReturnsStaticInstance(): void
    {
        $cabinet = $this->createStub(Cabinet::class);
        $cabinet->method('addMedecin')->willReturn($cabinet);

        $result = $this->medecin->addCabinet($cabinet);

        $this->assertSame($this->medecin, $result);
    }

    public function testAddCabinetDoesNotAddDuplicate(): void
    {
        $cabinet = $this->createStub(Cabinet::class);
        $cabinet->method('addMedecin')->willReturn($cabinet);

        $this->medecin->addCabinet($cabinet);
        $this->medecin->addCabinet($cabinet);

        $this->assertCount(1, $this->medecin->getCabinets());
    }

    public function testAddCabinetCallsAddMedecinOnCabinet(): void
    {
        $cabinet = $this->createMock(Cabinet::class);
        $cabinet->expects($this->once())
            ->method('addMedecin')
            ->with($this->medecin);

        $this->medecin->addCabinet($cabinet);
    }

    public function testRemoveCabinetDecreasesCount(): void
    {
        $cabinet = $this->createStub(Cabinet::class);
        $cabinet->method('addMedecin')->willReturn($cabinet);
        $cabinet->method('removeMedecin')->willReturn($cabinet);

        $this->medecin->addCabinet($cabinet);
        $this->medecin->removeCabinet($cabinet);

        $this->assertCount(0, $this->medecin->getCabinets());
    }

    public function testRemoveCabinetCallsRemoveMedecinOnCabinet(): void
    {
        $cabinet = $this->createMock(Cabinet::class);
        $cabinet->method('addMedecin')->willReturn($cabinet);
        $cabinet->expects($this->once())
            ->method('removeMedecin')
            ->with($this->medecin);

        $this->medecin->addCabinet($cabinet);
        $this->medecin->removeCabinet($cabinet);
    }

    // ─── Specialites ──────────────────────────────────────────────────────────

    public function testAddSpecialiteIncreasesCount(): void
    {
        $specialite = $this->createStub(Specialite::class);

        $this->medecin->addSpecialite($specialite);

        $this->assertCount(1, $this->medecin->getSpecialites());
    }

    public function testAddSpecialiteReturnsStaticInstance(): void
    {
        $specialite = $this->createStub(Specialite::class);

        $result = $this->medecin->addSpecialite($specialite);

        $this->assertSame($this->medecin, $result);
    }

    public function testAddSpecialiteDoesNotAddDuplicate(): void
    {
        $specialite = $this->createStub(Specialite::class);

        $this->medecin->addSpecialite($specialite);
        $this->medecin->addSpecialite($specialite);

        $this->assertCount(1, $this->medecin->getSpecialites());
    }

    public function testRemoveSpecialiteDecreasesCount(): void
    {
        $specialite = $this->createStub(Specialite::class);

        $this->medecin->addSpecialite($specialite);
        $this->medecin->removeSpecialite($specialite);

        $this->assertCount(0, $this->medecin->getSpecialites());
    }

    public function testRemoveSpecialiteReturnsStaticInstance(): void
    {
        $specialite = $this->createStub(Specialite::class);

        $this->medecin->addSpecialite($specialite);
        $result = $this->medecin->removeSpecialite($specialite);

        $this->assertSame($this->medecin, $result);
    }

    // ─── __toString ───────────────────────────────────────────────────────────

    public function testToStringReturnsPrenomEtNom(): void
    {
        $this->medecin->setPrenom('Jean');
        $this->medecin->setNom('Dupont');

        $this->assertSame('Jean Dupont', (string) $this->medecin);
    }
}