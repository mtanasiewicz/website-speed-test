<?php
declare(strict_types=1);

namespace App\Benchmark\Ui\Http\Form;

use App\Benchmark\Ui\Http\Request\BenchmarkData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BenchmarkForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('benchmarkUrl', TextType::class)
            ->add('comparedUrls', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
            ])
            ->add('email', EmailType::class)
            ->add('phoneNumber', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BenchmarkData::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return null;
    }
}