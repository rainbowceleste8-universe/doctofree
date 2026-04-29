<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Consultation;
use App\Entity\Ordonnance;
use App\Entity\Rendezvous;
use PHPUnit\Framework\TestCase;

class ConsultationTest extends TestCase
{
    private Consultation $consultation;

    protected function setUp(): void
    {
        $this->consultation = new Consultation();
    }

    // ─── Initialisation ───────────────────────────────────────────────────────

    public function testIdIsNullOnCreation(): void
    {
        $this->assertNull($this->consultation->getId());
    }

    public function testDateHeureIsNullOnCreation(): void
    {
        $this->assertNull($this->consultation->getDateHeure());
    }

    public function testAnamneseIsNullOnCreation(): void
    {
        $this->assertNull($this->consultation->getAnamnese());
    }

    public function testDiagnosticIsNullOnCreation(): void
    {
        $this->assertNull($this->consultation->getDiagnostic());
    }

    public function testNotesIsNullOnCreation(): void
    {
        $this->assertNull($this->consultation->getNotes());
    }

    public function testRendezVousIsNullOnCreation(): void
    {
        $this->assertNull($this->consultation->getRendezVous());
    }

    public function testOrdonnanceIsNullOnCreation(): void
    {
        $this->assertNull($this->consultation->getOrdonnance());
    }

    // ─── DateHeure ────────────────────────────────────────────────────────────

    public function testSetDateHeureReturnsStaticInstance(): void
    {
        $result = $this->consultation->setDateHeure(new \DateTime());

        $this->assertSame($this->consultation, $result);
    }

    public function testSetAndGetDateHeure(): void
    {
        $date = new \DateTime('2025-06-15 10:00:00');
        $this->consultation->setDateHeure($date);

        $this->assertSame($date, $this->consultation->getDateHeure());
    }

    public function testSetDateHeureOverwritesPreviousValue(): void
    {
        $date1 = new \DateTime('2025-06-15 10:00:00');
        $date2 = new \DateTime('2025-07-20 14:30:00');

        $this->consultation->setDateHeure($date1);
        $this->consultation->setDateHeure($date2);

        $this->assertSame($date2, $this->consultation->getDateHeure());
    }

    // ─── Anamnese ─────────────────────────────────────────────────────────────

    public function testSetAnamneseReturnsStaticInstance(): void
    {
        $result = $this->consultation->setAnamnese('Douleurs thoraciques depuis 3 jours');

        $this->assertSame($this->consultation, $result);
    }

    public function testSetAndGetAnamnese(): void
    {
        $this->consultation->setAnamnese('Douleurs thoraciques depuis 3 jours');

        $this->assertSame('Douleurs thoraciques depuis 3 jours', $this->consultation->getAnamnese());
    }

    public function testSetAnamneseAcceptsNull(): void
    {
        $this->consultation->setAnamnese('Douleurs thoraciques depuis 3 jours');
        $this->consultation->setAnamnese(null);

        $this->assertNull($this->consultation->getAnamnese());
    }

    // ─── Diagnostic ───────────────────────────────────────────────────────────

    public function testSetDiagnosticReturnsStaticInstance(): void
    {
        $result = $this->consultation->setDiagnostic('Hypertension artérielle');

        $this->assertSame($this->consultation, $result);
    }

    public function testSetAndGetDiagnostic(): void
    {
        $this->consultation->setDiagnostic('Hypertension artérielle');

        $this->assertSame('Hypertension artérielle', $this->consultation->getDiagnostic());
    }

    public function testSetDiagnosticOverwritesPreviousValue(): void
    {
        $this->consultation->setDiagnostic('Hypertension artérielle');
        $this->consultation->setDiagnostic('Migraine chronique');

        $this->assertSame('Migraine chronique', $this->consultation->getDiagnostic());
    }

    // ─── Notes ────────────────────────────────────────────────────────────────

    public function testSetNotesReturnsStaticInstance(): void
    {
        $result = $this->consultation->setNotes('Contrôle dans 1 mois');

        $this->assertSame($this->consultation, $result);
    }

    public function testSetAndGetNotes(): void
    {
        $this->consultation->setNotes('Contrôle dans 1 mois');

        $this->assertSame('Contrôle dans 1 mois', $this->consultation->getNotes());
    }

    public function testSetNotesAcceptsNull(): void
    {
        $this->consultation->setNotes('Contrôle dans 1 mois');
        $this->consultation->setNotes(null);

        $this->assertNull($this->consultation->getNotes());
    }

    // ─── RendezVous ───────────────────────────────────────────────────────────

    public function testSetRendezVousReturnsStaticInstance(): void
    {
        $rdv = $this->createStub(Rendezvous::class);
        $result = $this->consultation->setRendezVous($rdv);

        $this->assertSame($this->consultation, $result);
    }

    public function testSetAndGetRendezVous(): void
    {
        $rdv = $this->createStub(Rendezvous::class);
        $this->consultation->setRendezVous($rdv);

        $this->assertSame($rdv, $this->consultation->getRendezVous());
    }

    public function testSetRendezVousOverwritesPreviousValue(): void
    {
        $rdv1 = $this->createStub(Rendezvous::class);
        $rdv2 = $this->createStub(Rendezvous::class);

        $this->consultation->setRendezVous($rdv1);
        $this->consultation->setRendezVous($rdv2);

        $this->assertSame($rdv2, $this->consultation->getRendezVous());
    }

    // ─── Ordonnance ───────────────────────────────────────────────────────────

    public function testSetOrdonnanceReturnsStaticInstance(): void
    {
        $ordonnance = $this->createStub(Ordonnance::class);
        $result = $this->consultation->setOrdonnance($ordonnance);

        $this->assertSame($this->consultation, $result);
    }

    public function testSetAndGetOrdonnance(): void
    {
        $ordonnance = $this->createStub(Ordonnance::class);
        $this->consultation->setOrdonnance($ordonnance);

        $this->assertSame($ordonnance, $this->consultation->getOrdonnance());
    }

    public function testSetOrdonnanceAcceptsNull(): void
    {
        $ordonnance = $this->createStub(Ordonnance::class);

        $this->consultation->setOrdonnance($ordonnance);
        $this->consultation->setOrdonnance(null);

        $this->assertNull($this->consultation->getOrdonnance());
    }
}