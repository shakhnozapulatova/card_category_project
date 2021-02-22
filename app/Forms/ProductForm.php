<?php

namespace App\Forms;

use App\Models\AttributeOption;
use App\Models\Product;
use App\Models\User;
use App\Services\HierarchicalFormatter;
use Saodat\FormBase\Contracts\FormBuilderInterface;

class ProductForm extends AbstractForm
{
    /**
     * @var HierarchicalFormatter
     */
    private $hierarchicalFormatter;

    public function __construct(FormBuilderInterface $formBuilder)
    {
        $this->hierarchicalFormatter = new HierarchicalFormatter;
        parent::__construct($formBuilder);
    }

    protected function buildForm()
    {
        $this->formBuilder
            ->add('text', 'name', 'Наименование',
                [
                    'validationRule' => 'required',
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6
                    ],
                ]);

        $this->formBuilder
            ->add('text', 'old_name', 'Наименование (Старое значение)',
                [
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6,
                        'disabled' => true
                    ],
                ]);


        $this->formBuilder
            ->add('treeselect', 'data.atx', 'Код АТХ',
                [
                    'validationRule' => 'required',
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6,

                    ],
                    'options' => $this->getFormattedAtxOptions()
                ]);

        $this->formBuilder
            ->add('text', 'data.old_atx', 'Код АТХ (Старое значение)',
                [
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6,
                        'disabled' => true
                    ],
                ]);

        $this->formBuilder
            ->add('text', 'data.country_producer', 'Страна производитель',
                [
                    'validationRule' => 'required',
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6,
                    ],
                ]);

        $this->formBuilder
            ->add('text', 'data.old_country_producer', 'Страна производитель (Старое значение)',
                [
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6,
                        'disabled' => true
                    ],
                ]);

        $this->formBuilder
            ->add('text', 'data.mnn', 'МНН',
                [
                    'validationRule' => 'required',
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6,
                    ],
                ]);

        $this->formBuilder
            ->add('text', 'data.old_mnn', 'МНН (Старое значение)',
                [
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6,
                        'disabled' => true
                    ],
                ]);

        $this->formBuilder
            ->add('treeselect', 'data.category', 'Категория',
                [
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6
                    ],
                    'options' => []
                ]);

        $this->formBuilder
            ->add('select', 'data.user_id', 'Модератор',
                [
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 6,
                    ],
                    'options' => User::all()->map(function($user) {
                        return [
                          'id' => $user->id,
                            'name' => $user->name
                        ];
                    })
                ]);
    }

    public function fill(Product $product)
    {
        foreach ($this->formBuilder->getFields() as $field) {
            $field->setValue($product->{$field->getName()});

            foreach ($product->data as $productData) {
                if ($field->getName() === 'data.' . $productData->name) {
                    $field->setValue($productData->value);
                }
            }
        }

        return $this;
    }

    private function getFormattedAtxOptions(): array
    {
        $atxOptions = AttributeOption::where('attribute', 'atx')
            ->get()
            ->map(function ($option) {
                return [
                    'id' => $option->id,
                    'name' => "{$option->value} - {$option->name}",
                    'parent_id' => $option->parent_id
                ];
            })
            ->toArray();

        return $this->hierarchicalFormatter->formatRecursively($atxOptions);
    }
}
