<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Consultation;
use App\Entity\Ordonnance;
use App\Entity\Prescription;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class OrdonnanceTest extends TestCase
{
    private Ordonnance $ordonnance;

    protected function setUp(): void
    {
        $this->ordonnance = new Ordonnance();
    }

    // ─── Initialisation ───────────────────────────────────────────────────────

    public function testIdIsNullOnCreation(): void
    {
        $this->assertNull($this->ordonnance->getId());
    }

    public function testDateEmissionIsNullOnCreation(): void
    {
        $this->assertNull($this->ordonnance->getDateEmission());
    }

    public function testDateValiditeIsNullOnCreation(): void
    {
        $this->assertNull($this->ordonnance->getDateValidite());
    }

    public function testInstructionsIsNullOnCreation(): void
    {
        $this->assertNull($this->ordonnance->getInstructions());
    }

    public function testConsultationIsNullOnCreation(): void
    {
        $this->assertNull($this->ordonnance->getConsultation());
    }

    public function testPrescriptionsIsEmptyCollectionOnCreation(): void
    {
        $collection = $this->ordonnance->getPrescriptions();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(0, $collection);
    }

    // ─── DateEmission ─────────────────────────────────────────────────────────

    public function testSetDateEmissionReturnsStaticInstance(): void
    {
        $result = $this->ordonnance->setDateEmission(new \DateTimeImmutable());

        $this->assertSame($this->ordonnance, $result);
    }

    public function testSetAndGetDateEmission(): void
    {
        $date = new \DateTimeImmutable('2025-06-15');
        $this->ordonnance->setDateEmission($date);

        $this->assertSame($date, $this->ordonnance->getDateEmission());
    }

    public function testSetDateEmissionOverwritesPreviousValue(): void
    {
        $date1 = new \DateTimeImmutable('2025-06-15');
        $date2 = new \DateTimeImmutable('2025-07-20');

        $this->ordonnance->setDateEmission($date1);
        $this->ordonnance->setDateEmission($date2);

        $this->assertSame($date2, $this->ordonnance->getDateEmission());
    }

    // ─── DateValidite ─────────────────────────────────────────────────────────

    public function testSetDateValiditeReturnsStaticInstance(): void
    {
        $result = $this->ordonnance->setDateValidite(new \DateTimeImmutable());

        $this->assertSame($this->ordonnance, $result);
    }

    public function testSetAndGetDateValidite(): void
    {
        $date = new \DateTimeImmutable('2025-09-15');
        $this->ordonnance->setDateValidite($date);

        $this->assertSame($date, $this->ordonnance->getDateValidite());
    }

    public function testDateValiditeIsAfterDateEmission(): void
    {
        $emission = new \DateTimeImmutable('2025-06-15');
        $validite = new \DateTimeImmutable('2025-09-15');

        $this->ordonnance->setDateEmission($emission);
        $this->ordonnance->setDateValidite($validite);

        $this->assertGreaterThan(
            $this->ordonnance->getDateEmission(),
            $this->ordonnance->getDateValidite()
        );
    }

    // ─── Instructions ─────────────────────────────────────────────────────────

    public function testSetInstructionsReturnsStaticInstance(): void
    {
        $result = $this->ordonnance->setInstructions('Prendre 1 comprimé matin et soir');

        $this->assertSame($this->ordonnance, $result);
    }

    public function testSetAndGetInstructions(): void
    {
        $this->ordonnance->setInstructions('Prendre 1 comprimé matin et soir');

        $this->assertSame('Prendre 1 comprimé matin et soir', $this->ordonnance->getInstructions());
    }

    public function testSetInstructionsOverwritesPreviousValue(): void
    {
        $this->ordonnance->setInstructions('Prendre 1 comprimé matin et soir');
        $this->ordonnance->setInstructions('Prendre 2 comprimés le midi');

        $this->assertSame('Prendre 2 comprimés le midi', $this->ordonnance->getInstructions());
    }

    // ─── Consultation ─────────────────────────────────────────────────────────

    public function testSetConsultationReturnsStaticInstance(): void
    {
        $consultation = $this->createStub(Consultation::class);
        $result = $this->ordonnance->setConsultation($consultation);

        $this->assertSame($this->ordonnance, $result);
    }

    public function testSetAndGetConsultation(): void
    {
        $consultation = $this->createStub(Consultation::class);
        $this->ordonnance->setConsultation($consultation);

        $this->assertSame($consultation, $this->ordonnance->getConsultation());
    }

    public function testSetConsultationOverwritesPreviousValue(): void
    {
        $consultation1 = $this->createStub(Consultation::class);
        $consultation2 = $this->createStub(Consultation::class);

        $this->ordonnance->setConsultation($consultation1);
        $this->ordonnance->setConsultation($consultation2);

        $this->assertSame($consultation2, $this->ordonnance->getConsultation());
    }

    // ─── Prescriptions ────────────────────────────────────────────────────────

    public function testAddPrescriptionIncreasesCount(): void
    {
        $prescription = $this->createStub(Prescription::class);
        $prescription->method('setOrdonnance')->willReturn($prescription);

        $this->ordonnance->addPrescription($prescription);

        $this->assertCount(1, $this->ordonnance->getPrescriptions());
    }

    public function testAddPrescriptionReturnsStaticInstance(): void
    {
        $prescription = $this->createStub(Prescription::class);
        $prescription->method('setOrdonnance')->willReturn($prescription);

        $result = $this->ordonnance->addPrescription($prescription);

        $this->assertSame($this->ordonnance, $result);
    }

    public function testAddPrescriptionDoesNotAddDuplicate(): void
    {
        $prescription = $this->createStub(Prescription::class);
        $prescription->method('setOrdonnance')->willReturn($prescription);

        $this->ordonnance->addPrescription($prescription);
        $this->ordonnance->addPrescription($prescription);

        $this->assertCount(1, $this->ordonnance->getPrescriptions());
    }

    public function testAddPrescriptionCallsSetOrdonnanceOnPrescription(): void
    {
        $prescription = $this->createMock(Prescription::class);
        $prescription->expects($this->once())
            ->method('setOrdonnance')
            ->with($this->ordonnance);

        $this->ordonnance->addPrescription($prescription);
    }

    public function testRemovePrescriptionDecreasesCount(): void
    {
        $prescription = new Prescription();

        $this->ordonnance->addPrescription($prescription);
        $this->ordonnance->removePrescription($prescription);

        $this->assertCount(0, $this->ordonnance->getPrescriptions());
    }

    public function testRemovePrescriptionReturnsStaticInstance(): void
    {
        $prescription = new Prescription();

        $this->ordonnance->addPrescription($prescription);
        $result = $this->ordonnance->removePrescription($prescription);

        $this->assertSame($this->ordonnance, $result);
    }

    public function testRemovePrescriptionSetsNullWhenOwnerMatches(): void
    {
        $prescription = new Prescription();

        $this->ordonnance->addPrescription($prescription);
        $this->ordonnance->removePrescription($prescription);

        $this->assertNull($prescription->getOrdonnance());
    }

    public function testRemovePrescriptionDoesNotSetNullWhenOwnerChanged(): void
    {
        $autreOrdonnance = new Ordonnance();
        $prescription = new Prescription();

        $this->ordonnance->addPrescription($prescription);
        $prescription->setOrdonnance($autreOrdonnance);

        $this->ordonnance->removePrescription($prescription);

        $this->assertSame($autreOrdonnance, $prescription->getOrdonnance());
    }
}