<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Patient;
use App\Entity\Rendezvous;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class PatientTest extends TestCase
{
    private Patient $patient;

    protected function setUp(): void
    {
        $this->patient = new Patient();
    }

    // ─── Initialisation ───────────────────────────────────────────────────────

    public function testIdIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getId());
    }

    public function testNomIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getNom());
    }

    public function testPrenomIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getPrenom());
    }

    public function testDateNaissanceIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getDateNaissance());
    }

    public function testSexeIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getSexe());
    }

    public function testAdresseIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getAdresse());
    }

    public function testTelephoneIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getTelephone());
    }

    public function testEmailIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getEmail());
    }

    public function testNumeroSecuIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getNumeroSecu());
    }

    public function testDateInscriptionIsNullOnCreation(): void
    {
        $this->assertNull($this->patient->getDateInscription());
    }

    public function testListeRendezVousIsEmptyCollectionOnCreation(): void
    {
        $collection = $this->patient->getListeRendezVous();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(0, $collection);
    }

    // ─── Nom ──────────────────────────────────────────────────────────────────

    public function testSetNomReturnsStaticInstance(): void
    {
        $result = $this->patient->setNom('Dupont');

        $this->assertSame($this->patient, $result);
    }

    public function testSetAndGetNom(): void
    {
        $this->patient->setNom('Dupont');

        $this->assertSame('Dupont', $this->patient->getNom());
    }

    public function testSetNomOverwritesPreviousValue(): void
    {
        $this->patient->setNom('Dupont');
        $this->patient->setNom('Martin');

        $this->assertSame('Martin', $this->patient->getNom());
    }

    // ─── Prenom ───────────────────────────────────────────────────────────────

    public function testSetPrenomReturnsStaticInstance(): void
    {
        $result = $this->patient->setPrenom('Marie');

        $this->assertSame($this->patient, $result);
    }

    public function testSetAndGetPrenom(): void
    {
        $this->patient->setPrenom('Marie');

        $this->assertSame('Marie', $this->patient->getPrenom());
    }

    // ─── DateNaissance ────────────────────────────────────────────────────────

    public function testSetDateNaissanceReturnsStaticInstance(): void
    {
        $result = $this->patient->setDateNaissance(new \DateTimeImmutable('1990-05-20'));

        $this->assertSame($this->patient, $result);
    }

    public function testSetAndGetDateNaissance(): void
    {
        $date = new \DateTimeImmutable('1990-05-20');
        $this->patient->setDateNaissance($date);

        $this->assertSame($date, $this->patient->getDateNaissance());
    }

    public function testDateNaissanceIsInThePast(): void
    {
        $date = new \DateTimeImmutable('1990-05-20');
        $this->patient->setDateNaissance($date);

        $this->assertLessThan(new \DateTimeImmutable('today'), $this->patient->getDateNaissance());
    }

    // ─── Sexe ─────────────────────────────────────────────────────────────────

    public function testSetSexeReturnsStaticInstance(): void
    {
        $result = $this->patient->setSexe('F');

        $this->assertSame($this->patient, $result);
    }

    public function testSetAndGetSexe(): void
    {
        $this->patient->setSexe('F');

        $this->assertSame('F', $this->patient->getSexe());
    }

    public function testSetSexeOverwritesPreviousValue(): void
    {
        $this->patient->setSexe('F');
        $this->patient->setSexe('M');

        $this->assertSame('M', $this->patient->getSexe());
    }

    // ─── Adresse ──────────────────────────────────────────────────────────────

    public function testSetAdresseReturnsStaticInstance(): void
    {
        $result = $this->patient->setAdresse('12 rue de la Paix, 75001 Paris');

        $this->assertSame($this->patient, $result);
    }

    public function testSetAndGetAdresse(): void
    {
        $this->patient->setAdresse('12 rue de la Paix, 75001 Paris');

        $this->assertSame('12 rue de la Paix, 75001 Paris', $this->patient->getAdresse());
    }

    // ─── Telephone ────────────────────────────────────────────────────────────

    public function testSetTelephoneReturnsStaticInstance(): void
    {
        $result = $this->patient->setTelephone('0601020304');

        $this->assertSame($this->patient, $result);
    }

    public function testSetAndGetTelephone(): void
    {
        $this->patient->setTelephone('0601020304');

        $this->assertSame('0601020304', $this->patient->getTelephone());
    }

    // ─── Email ────────────────────────────────────────────────────────────────

    public function testSetEmailReturnsStaticInstance(): void
    {
        $result = $this->patient->setEmail('marie.dupont@exemple.fr');

        $this->assertSame($this->patient, $result);
    }

    public function testSetAndGetEmail(): void
    {
        $this->patient->setEmail('marie.dupont@exemple.fr');

        $this->assertSame('marie.dupont@exemple.fr', $this->patient->getEmail());
    }

    // ─── NumeroSecu ───────────────────────────────────────────────────────────

    public function testSetNumeroSecuReturnsStaticInstance(): void
    {
        $result = $this->patient->setNumeroSecu('2900512345678');

        $this->assertSame($this->patient, $result);
    }

    public function testSetAndGetNumeroSecu(): void
    {
        $this->patient->setNumeroSecu('2900512345678');

        $this->assertSame('2900512345678', $this->patient->getNumeroSecu());
    }

    // ─── DateInscription ──────────────────────────────────────────────────────

    public function testSetDateInscriptionReturnsStaticInstance(): void
    {
        $result = $this->patient->setDateInscription(new \DateTimeImmutable('2024-01-15'));

        $this->assertSame($this->patient, $result);
    }

    public function testSetAndGetDateInscription(): void
    {
        $date = new \DateTimeImmutable('2024-01-15');
        $this->patient->setDateInscription($date);

        $this->assertSame($date, $this->patient->getDateInscription());
    }

    public function testDateInscriptionIsAfterDateNaissance(): void
    {
        $this->patient->setDateNaissance(new \DateTimeImmutable('1990-05-20'));
        $this->patient->setDateInscription(new \DateTimeImmutable('2024-01-15'));

        $this->assertGreaterThan(
            $this->patient->getDateNaissance(),
            $this->patient->getDateInscription()
        );
    }

    // ─── ListeRendezVous ──────────────────────────────────────────────────────

    public function testAddListeRendezVouIncreasesCount(): void
    {
        $rdv = new Rendezvous();

        $this->patient->addListeRendezVou($rdv);

        $this->assertCount(1, $this->patient->getListeRendezVous());
    }

    public function testAddListeRendezVouReturnsStaticInstance(): void
    {
        $rdv = new Rendezvous();

        $result = $this->patient->addListeRendezVou($rdv);

        $this->assertSame($this->patient, $result);
    }

    public function testAddListeRendezVouDoesNotAddDuplicate(): void
    {
        $rdv = new Rendezvous();

        $this->patient->addListeRendezVou($rdv);
        $this->patient->addListeRendezVou($rdv);

        $this->assertCount(1, $this->patient->getListeRendezVous());
    }

    public function testAddListeRendezVouSetsPatientOnRdv(): void
    {
        $rdv = new Rendezvous();

        $this->patient->addListeRendezVou($rdv);

        $this->assertSame($this->patient, $rdv->getPatient());
    }

    public function testRemoveListeRendezVouDecreasesCount(): void
    {
        $rdv = new Rendezvous();

        $this->patient->addListeRendezVou($rdv);
        $this->patient->removeListeRendezVou($rdv);

        $this->assertCount(0, $this->patient->getListeRendezVous());
    }

    public function testRemoveListeRendezVouReturnsStaticInstance(): void
    {
        $rdv = new Rendezvous();

        $this->patient->addListeRendezVou($rdv);
        $result = $this->patient->removeListeRendezVou($rdv);

        $this->assertSame($this->patient, $result);
    }

    public function testRemoveListeRendezVouSetsNullWhenOwnerMatches(): void
    {
        $rdv = new Rendezvous();

        $this->patient->addListeRendezVou($rdv);
        $this->patient->removeListeRendezVou($rdv);

        $this->assertNull($rdv->getPatient());
    }

    public function testRemoveListeRendezVouDoesNotSetNullWhenOwnerChanged(): void
    {
        $autrePatient = new Patient();
        $rdv = new Rendezvous();

        $this->patient->addListeRendezVou($rdv);
        $rdv->setPatient($autrePatient);

        $this->patient->removeListeRendezVou($rdv);

        $this->assertSame($autrePatient, $rdv->getPatient());
    }

    // ─── __toString ───────────────────────────────────────────────────────────

    public function testToStringReturnsPrenomEtNom(): void
    {
        $this->patient->setPrenom('Marie');
        $this->patient->setNom('Dupont');

        $this->assertSame('Marie Dupont', (string) $this->patient);
    }
}