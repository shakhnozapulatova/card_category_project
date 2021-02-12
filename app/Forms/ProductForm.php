<?php

namespace App\Forms;

use App\Enums\ProductStatus;
use App\Models\Category;
use App\Models\Product;
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
                        'cols' => 12
                    ],
                ]);


        $this->formBuilder->add('treeselect', 'category_id', 'Категория',
            [
                'options' => $this->hierarchicalFormatter->formatRecursively(Category::all()->toArray()),
                'placeholder' => 'Категория',
                'attributes' => [
                    'outlined' => true,
                    'cols' => 12
                ],
            ]);


        $this->formBuilder->add('select', 'status', 'Статус',
            [
                'placeholder' => 'Категория',
                'validationRule' => 'required',
                'attributes' => [
                    'outlined' => true,
                    'cols' => 12
                ],
                'options' => [
                    [
                        'id' => ProductStatus::PENDING,
                        'name' => 'Ожидает модерацию'
                    ],
                    [
                        'id' => ProductStatus::PUBLISHED,
                        'name' => 'Опубликован'
                    ]
                ],
            ]);

        $this->formBuilder
            ->add('number', 'order', 'Порядок',
                [
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 12
                    ],
                ]);
    }

    public function fill(Product $product)
    {
        foreach ($this->formBuilder->getFields() as $field) {
            $field->setValue($product->{$field->getName()});
        }

        return $this;
    }
}
