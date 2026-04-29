<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Consultation;
use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Rendezvous;
use PHPUnit\Framework\TestCase;

class RendezvousTest extends TestCase
{
    private Rendezvous $rendezvous;

    protected function setUp(): void
    {
        $this->rendezvous = new Rendezvous();
    }

    // ─── Initialisation ───────────────────────────────────────────────────────

    public function testIdIsNullOnCreation(): void
    {
        $this->assertNull($this->rendezvous->getId());
    }

    public function testDateHeureIsNullOnCreation(): void
    {
        $this->assertNull($this->rendezvous->getDateHeure());
    }

    public function testDureeMinutesIsNullOnCreation(): void
    {
        $this->assertNull($this->rendezvous->getDureeMinutes());
    }

    public function testStatutIsNullOnCreation(): void
    {
        $this->assertNull($this->rendezvous->getStatut());
    }

    public function testMotifIsNullOnCreation(): void
    {
        $this->assertNull($this->rendezvous->getMotif());
    }

    public function testMedecinIsNullOnCreation(): void
    {
        $this->assertNull($this->rendezvous->getMedecin());
    }

    public function testPatientIsNullOnCreation(): void
    {
        $this->assertNull($this->rendezvous->getPatient());
    }

    public function testConsultationIsNullOnCreation(): void
    {
        $this->assertNull($this->rendezvous->getConsultation());
    }

    // ─── DateHeure ────────────────────────────────────────────────────────────

    public function testSetDateHeureReturnsStaticInstance(): void
    {
        $result = $this->rendezvous->setDateHeure(new \DateTime());

        $this->assertSame($this->rendezvous, $result);
    }

    public function testSetAndGetDateHeure(): void
    {
        $date = new \DateTime('2025-06-15 09:30:00');
        $this->rendezvous->setDateHeure($date);

        $this->assertSame($date, $this->rendezvous->getDateHeure());
    }

    public function testSetDateHeureOverwritesPreviousValue(): void
    {
        $date1 = new \DateTime('2025-06-15 09:30:00');
        $date2 = new \DateTime('2025-07-20 14:00:00');

        $this->rendezvous->setDateHeure($date1);
        $this->rendezvous->setDateHeure($date2);

        $this->assertSame($date2, $this->rendezvous->getDateHeure());
    }

    // ─── DureeMinutes ─────────────────────────────────────────────────────────

    public function testSetDureeMinutesReturnsStaticInstance(): void
    {
        $result = $this->rendezvous->setDureeMinutes(30);

        $this->assertSame($this->rendezvous, $result);
    }

    public function testSetAndGetDureeMinutes(): void
    {
        $this->rendezvous->setDureeMinutes(30);

        $this->assertSame(30, $this->rendezvous->getDureeMinutes());
    }

    public function testSetDureeMinutesOverwritesPreviousValue(): void
    {
        $this->rendezvous->setDureeMinutes(30);
        $this->rendezvous->setDureeMinutes(60);

        $this->assertSame(60, $this->rendezvous->getDureeMinutes());
    }

    // ─── Statut ───────────────────────────────────────────────────────────────

    public function testSetStatutReturnsStaticInstance(): void
    {
        $result = $this->rendezvous->setStatut('planifié');

        $this->assertSame($this->rendezvous, $result);
    }

    public function testSetAndGetStatut(): void
    {
        $this->rendezvous->setStatut('planifié');

        $this->assertSame('planifié', $this->rendezvous->getStatut());
    }

    public function testSetStatutOverwritesPreviousValue(): void
    {
        $this->rendezvous->setStatut('planifié');
        $this->rendezvous->setStatut('annulé');

        $this->assertSame('annulé', $this->rendezvous->getStatut());
    }

    // ─── Motif ────────────────────────────────────────────────────────────────

    public function testSetMotifReturnsStaticInstance(): void
    {
        $result = $this->rendezvous->setMotif('Consultation générale');

        $this->assertSame($this->rendezvous, $result);
    }

    public function testSetAndGetMotif(): void
    {
        $this->rendezvous->setMotif('Consultation générale');

        $this->assertSame('Consultation générale', $this->rendezvous->getMotif());
    }

    // ─── Medecin ──────────────────────────────────────────────────────────────

    public function testSetMedecinReturnsStaticInstance(): void
    {
        $medecin = $this->createStub(Medecin::class);
        $result = $this->rendezvous->setMedecin($medecin);

        $this->assertSame($this->rendezvous, $result);
    }

    public function testSetAndGetMedecin(): void
    {
        $medecin = $this->createStub(Medecin::class);
        $this->rendezvous->setMedecin($medecin);

        $this->assertSame($medecin, $this->rendezvous->getMedecin());
    }

    public function testSetMedecinAcceptsNull(): void
    {
        $medecin = $this->createStub(Medecin::class);

        $this->rendezvous->setMedecin($medecin);
        $this->rendezvous->setMedecin(null);

        $this->assertNull($this->rendezvous->getMedecin());
    }

    // ─── Patient ──────────────────────────────────────────────────────────────

    public function testSetPatientReturnsStaticInstance(): void
    {
        $patient = $this->createStub(Patient::class);
        $result = $this->rendezvous->setPatient($patient);

        $this->assertSame($this->rendezvous, $result);
    }

    public function testSetAndGetPatient(): void
    {
        $patient = $this->createStub(Patient::class);
        $this->rendezvous->setPatient($patient);

        $this->assertSame($patient, $this->rendezvous->getPatient());
    }

    public function testSetPatientAcceptsNull(): void
    {
        $patient = $this->createStub(Patient::class);

        $this->rendezvous->setPatient($patient);
        $this->rendezvous->setPatient(null);

        $this->assertNull($this->rendezvous->getPatient());
    }

    // ─── Consultation ─────────────────────────────────────────────────────────

    public function testSetConsultationReturnsStaticInstance(): void
    {
        $consultation = $this->createStub(Consultation::class);
        $result = $this->rendezvous->setConsultation($consultation);

        $this->assertSame($this->rendezvous, $result);
    }

    public function testSetAndGetConsultation(): void
    {
        $consultation = $this->createStub(Consultation::class);
        $this->rendezvous->setConsultation($consultation);

        $this->assertSame($consultation, $this->rendezvous->getConsultation());
    }

    public function testSetConsultationAcceptsNull(): void
    {
        $consultation = $this->createStub(Consultation::class);

        $this->rendezvous->setConsultation($consultation);
        $this->rendezvous->setConsultation(null);

        $this->assertNull($this->rendezvous->getConsultation());
    }
}