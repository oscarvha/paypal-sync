<?php

namespace OscarVha\PaypalApi\Results\Subscription\ValueObject;

class Cycle
{
    private string $tenure;

    private int $sequence;

    private int $cyclesComplete;

    private int $cyclesRemaining;

    private int $cyclesWithThisPrive;

    private int $totalCycles;

    /**
     * @param string $tenure
     * @param int $sequence
     * @param int $cyclesComplete
     * @param int $cyclesRemaining
     * @param int $cyclesWithThisPrive
     * @param int $totalCycles
     */
    public function __construct(string $tenure, int $sequence, int $cyclesComplete, int $cyclesRemaining, int $cyclesWithThisPrive, int $totalCycles)
    {
        $this->tenure = $tenure;
        $this->sequence = $sequence;
        $this->cyclesComplete = $cyclesComplete;
        $this->cyclesRemaining = $cyclesRemaining;
        $this->cyclesWithThisPrive = $cyclesWithThisPrive;
        $this->totalCycles = $totalCycles;
    }


    /**
     * @return string
     */
    public function getTenure(): string
    {
        return $this->tenure;
    }

    /**
     * @return int
     */
    public function getSequence(): int
    {
        return $this->sequence;
    }

    /**
     * @return int
     */
    public function getCyclesComplete(): int
    {
        return $this->cyclesComplete;
    }

    /**
     * @return int
     */
    public function getCyclesRemaining(): int
    {
        return $this->cyclesRemaining;
    }

    /**
     * @return int
     */
    public function getCyclesWithThisPrive(): int
    {
        return $this->cyclesWithThisPrive;
    }

    /**
     * @return int
     */
    public function getTotalCycles(): int
    {
        return $this->totalCycles;
    }


    public static function createFromStdClass(\stdClass $cycle): Cycle
    {
        return new self($cycle->tenure_type,
                        $cycle->sequence,
                        $cycle->cycles_completed,
                        $cycle->cycles_remaining ,
                        $cycle->current_pricing_scheme_version ,
            $cycle->total_cycles);

    }
}
