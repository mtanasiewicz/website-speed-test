<?php
declare(strict_types=1);

namespace App\Benchmark\Ui\Http\Request;

use App\Shared\Ui\Validator\Constraint\Url;
use Symfony\Component\Validator\Constraints as Assert;

class BenchmarkData
{
    /**
     * @var string
     *
     * @Url()
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    public $benchmarkUrl;
    /**
     * @var string[]
     *
     * @Assert\All(
     *     @Url,
     *     @Assert\NotBlank(),
     *     @Assert\NotNull(),
     * )
     */
    public $comparedUrls;
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Email()
     */
    public $email;
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    public $phoneNumber;
}