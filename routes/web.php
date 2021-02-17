<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin');
});

Route::post('import-products', [App\Http\Controllers\ProductsImportController::class, 'import'])->name('import.products');
Route::get('atc-parse', function () {
    function recursivelyCreateAtx(array $data, $parentId = null)
    {
        $optionData = [
            'attribute' => 'atx',
            'name' => $data['text'],
            'value' => $data['code']
        ];

        if ($parentId) {
            $optionData['parent_id'] = $parentId;
        }

        $option = \App\Models\ProductAttributeOption::create($optionData);

        if (array_key_exists('children', $data)) {

            foreach ($data['children'] as $key => $value) {
                recursivelyCreateAtx($value, $option['id']);
            }
        }
    }

    $arr = [
        'id' => 'V',
        'text' => 'Прочие препараты',
        'countProducts' => 0,
        'code' => 'V',
        'children' => array (
            0 =>
                array (
                    'id' => 'V01',
                    'text' => 'Аллергены',
                    'countProducts' => 0,
                    'code' => 'V01',
                    'children' =>
                        array (
                            0 =>
                                array (
                                    'id' => 'V01A',
                                    'text' => 'Аллергены',
                                    'countProducts' => 0,
                                    'code' => 'V01A',
                                    'children' =>
                                        array (
                                            0 =>
                                                array (
                                                    'id' => 'V01AA',
                                                    'text' => 'Экстракты аллергенов',
                                                    'countProducts' => 0,
                                                    'code' => 'V01AA',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V01AA01',
                                                                    'text' => 'Аллергены птичьего пера',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V01AA01',
                                                                ),
                                                            1 =>
                                                                array (
                                                                    'id' => 'V01AA02',
                                                                    'text' => 'Аллергены пыльцы травы',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V01AA02',
                                                                ),
                                                            2 =>
                                                                array (
                                                                    'id' => 'V01AA03',
                                                                    'text' => 'Аллергены клеща домашней пыли',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V01AA03',
                                                                ),
                                                            3 =>
                                                                array (
                                                                    'id' => 'V01AA04',
                                                                    'text' => 'Аллергены плесневых и дрожжевых грибов',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V01AA04',
                                                                ),
                                                            4 =>
                                                                array (
                                                                    'id' => 'V01AA05',
                                                                    'text' => 'Аллергены пыльцы деревьев',
                                                                    'countProducts' => 1,
                                                                    'code' => 'V01AA05',
                                                                ),
                                                            5 =>
                                                                array (
                                                                    'id' => 'V01AA07',
                                                                    'text' => 'Аллергены насекомых',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V01AA07',
                                                                ),
                                                            6 =>
                                                                array (
                                                                    'id' => 'V01AA08',
                                                                    'text' => 'Аллергены пищевые',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V01AA08',
                                                                ),
                                                            7 =>
                                                                array (
                                                                    'id' => 'V01AA09',
                                                                    'text' => 'Аллергены текстильные',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V01AA09',
                                                                ),
                                                            8 =>
                                                                array (
                                                                    'id' => 'V01AA10',
                                                                    'text' => 'Аллергены цветов',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V01AA10',
                                                                ),
                                                            9 =>
                                                                array (
                                                                    'id' => 'V01AA11',
                                                                    'text' => 'Аллергены животных',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V01AA11',
                                                                ),
                                                            10 =>
                                                                array (
                                                                    'id' => 'V01AA20',
                                                                    'text' => 'Прочие аллергены',
                                                                    'countProducts' => 2,
                                                                    'code' => 'V01AA20',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                        ),
                                    'expanded' => false,
                                ),
                        ),
                    'expanded' => false,
                ),
            1 =>
                array (
                    'id' => 'V03',
                    'text' => 'Прочие разные препараты',
                    'countProducts' => 8,
                    'code' => 'V03',
                    'children' =>
                        array (
                            0 =>
                                array (
                                    'id' => 'V03A',
                                    'text' => 'Прочие разные препараты',
                                    'countProducts' => 55,
                                    'code' => 'V03A',
                                    'children' =>
                                        array (
                                            0 =>
                                                array (
                                                    'id' => 'V03AA',
                                                    'text' => 'Препараты для лечения хронического алкоголизма',
                                                    'countProducts' => 1,
                                                    'code' => 'V03AA',
                                                ),
                                            1 =>
                                                array (
                                                    'id' => 'V03AB',
                                                    'text' => 'Антидоты',
                                                    'countProducts' => 8,
                                                    'code' => 'V03AB',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V03AB01',
                                                                    'text' => 'Ipecacuanha',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB01',
                                                                ),
                                                            1 =>
                                                                array (
                                                                    'id' => 'V03AB02',
                                                                    'text' => 'Nalorphine',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB02',
                                                                ),
                                                            2 =>
                                                                array (
                                                                    'id' => 'V03AB03',
                                                                    'text' => 'Edetates',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB03',
                                                                ),
                                                            3 =>
                                                                array (
                                                                    'id' => 'V03AB04',
                                                                    'text' => 'Pralidoxime iodide',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB04',
                                                                ),
                                                            4 =>
                                                                array (
                                                                    'id' => 'V03AB05',
                                                                    'text' => 'Преднизолон и прометазин',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB05',
                                                                ),
                                                            5 =>
                                                                array (
                                                                    'id' => 'V03AB06',
                                                                    'text' => 'Thiosulphate',
                                                                    'countProducts' => 10,
                                                                    'code' => 'V03AB06',
                                                                ),
                                                            6 =>
                                                                array (
                                                                    'id' => 'V03AB08',
                                                                    'text' => 'Sodium nitrite',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB08',
                                                                ),
                                                            7 =>
                                                                array (
                                                                    'id' => 'V03AB09',
                                                                    'text' => 'Dimercaprol',
                                                                    'countProducts' => 9,
                                                                    'code' => 'V03AB09',
                                                                ),
                                                            8 =>
                                                                array (
                                                                    'id' => 'V03AB13',
                                                                    'text' => 'Obidoxime',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB13',
                                                                ),
                                                            9 =>
                                                                array (
                                                                    'id' => 'V03AB14',
                                                                    'text' => 'Protamine',
                                                                    'countProducts' => 8,
                                                                    'code' => 'V03AB14',
                                                                ),
                                                            10 =>
                                                                array (
                                                                    'id' => 'V03AB15',
                                                                    'text' => 'Naloxone',
                                                                    'countProducts' => 4,
                                                                    'code' => 'V03AB15',
                                                                ),
                                                            11 =>
                                                                array (
                                                                    'id' => 'V03AB16',
                                                                    'text' => 'Ethanol',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB16',
                                                                ),
                                                            12 =>
                                                                array (
                                                                    'id' => 'V03AB17',
                                                                    'text' => 'Methylthioninium chloride',
                                                                    'countProducts' => 1,
                                                                    'code' => 'V03AB17',
                                                                ),
                                                            13 =>
                                                                array (
                                                                    'id' => 'V03AB18',
                                                                    'text' => 'Potassium permanganate',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB18',
                                                                ),
                                                            14 =>
                                                                array (
                                                                    'id' => 'V03AB19',
                                                                    'text' => 'Physostigmine',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB19',
                                                                ),
                                                            15 =>
                                                                array (
                                                                    'id' => 'V03AB20',
                                                                    'text' => 'Copper sulfate',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB20',
                                                                ),
                                                            16 =>
                                                                array (
                                                                    'id' => 'V03AB21',
                                                                    'text' => 'Potassium iodide',
                                                                    'countProducts' => 3,
                                                                    'code' => 'V03AB21',
                                                                ),
                                                            17 =>
                                                                array (
                                                                    'id' => 'V03AB22',
                                                                    'text' => 'Amyl nitrite',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB22',
                                                                ),
                                                            18 =>
                                                                array (
                                                                    'id' => 'V03AB23',
                                                                    'text' => 'Acetylcysteine',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB23',
                                                                ),
                                                            19 =>
                                                                array (
                                                                    'id' => 'V03AB24',
                                                                    'text' => 'Дигиталисный антитоксин',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB24',
                                                                ),
                                                            20 =>
                                                                array (
                                                                    'id' => 'V03AB25',
                                                                    'text' => 'Flumazenil',
                                                                    'countProducts' => 1,
                                                                    'code' => 'V03AB25',
                                                                ),
                                                            21 =>
                                                                array (
                                                                    'id' => 'V03AB26',
                                                                    'text' => 'Methionine',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB26',
                                                                ),
                                                            22 =>
                                                                array (
                                                                    'id' => 'V03AB27',
                                                                    'text' => '4-dimethylaminophenol',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB27',
                                                                ),
                                                            23 =>
                                                                array (
                                                                    'id' => 'V03AB29',
                                                                    'text' => 'Cholinesterase',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB29',
                                                                ),
                                                            24 =>
                                                                array (
                                                                    'id' => 'V03AB31',
                                                                    'text' => 'Prussian blue',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB31',
                                                                ),
                                                            25 =>
                                                                array (
                                                                    'id' => 'V03AB32',
                                                                    'text' => 'Glutathione',
                                                                    'countProducts' => 4,
                                                                    'code' => 'V03AB32',
                                                                ),
                                                            26 =>
                                                                array (
                                                                    'id' => 'V03AB33',
                                                                    'text' => 'Hydroxocobalamin',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB33',
                                                                ),
                                                            27 =>
                                                                array (
                                                                    'id' => 'V03AB34',
                                                                    'text' => 'Fomepizole',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AB34',
                                                                ),
                                                            28 =>
                                                                array (
                                                                    'id' => 'V03AB35',
                                                                    'text' => 'Sugammadex',
                                                                    'countProducts' => 2,
                                                                    'code' => 'V03AB35',
                                                                ),
                                                            29 =>
                                                                array (
                                                                    'id' => 'V03AB37',
                                                                    'text' => 'Idarucizumab',
                                                                    'countProducts' => 1,
                                                                    'code' => 'V03AB37',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                            2 =>
                                                array (
                                                    'id' => 'V03AC',
                                                    'text' => 'Железосвязывающие препараты',
                                                    'countProducts' => 0,
                                                    'code' => 'V03AC',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V03AC01',
                                                                    'text' => 'Deferoxamine',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AC01',
                                                                ),
                                                            1 =>
                                                                array (
                                                                    'id' => 'V03AC02',
                                                                    'text' => 'Deferiprone',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AC02',
                                                                ),
                                                            2 =>
                                                                array (
                                                                    'id' => 'V03AC03',
                                                                    'text' => 'Deferasirox',
                                                                    'countProducts' => 8,
                                                                    'code' => 'V03AC03',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                            3 =>
                                                array (
                                                    'id' => 'V03AE',
                                                    'text' => 'Препараты для лечения гиперкалиемии и гиперфосфатемии',
                                                    'countProducts' => 2,
                                                    'code' => 'V03AE',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V03AE01',
                                                                    'text' => 'Polystyrene sulfonate',
                                                                    'countProducts' => 2,
                                                                    'code' => 'V03AE01',
                                                                ),
                                                            1 =>
                                                                array (
                                                                    'id' => 'V03AE02',
                                                                    'text' => 'Sevelamer',
                                                                    'countProducts' => 4,
                                                                    'code' => 'V03AE02',
                                                                ),
                                                            2 =>
                                                                array (
                                                                    'id' => 'V03AE03',
                                                                    'text' => 'Lanthanum carbonate',
                                                                    'countProducts' => 3,
                                                                    'code' => 'V03AE03',
                                                                ),
                                                            3 =>
                                                                array (
                                                                    'id' => 'V03AE04',
                                                                    'text' => 'Calcium actetate and magnesium carbonate',
                                                                    'countProducts' => 1,
                                                                    'code' => 'V03AE04',
                                                                ),
                                                            4 =>
                                                                array (
                                                                    'id' => 'V03AE05',
                                                                    'text' => 'Sucroferric oxyhydroxide',
                                                                    'countProducts' => 2,
                                                                    'code' => 'V03AE05',
                                                                ),
                                                            5 =>
                                                                array (
                                                                    'id' => 'V03AE06',
                                                                    'text' => 'Colestilan',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AE06',
                                                                ),
                                                            6 =>
                                                                array (
                                                                    'id' => 'V03AE07',
                                                                    'text' => 'Calcium acetate',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AE07',
                                                                ),
                                                            7 =>
                                                                array (
                                                                    'id' => 'V03AE08',
                                                                    'text' => 'Ferric citrate',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AE08',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                            4 =>
                                                array (
                                                    'id' => 'V03AF',
                                                    'text' => 'Препараты, снижающие токсичность цитостатической терапии',
                                                    'countProducts' => 0,
                                                    'code' => 'V03AF',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V03AF01',
                                                                    'text' => 'Mesna',
                                                                    'countProducts' => 3,
                                                                    'code' => 'V03AF01',
                                                                ),
                                                            1 =>
                                                                array (
                                                                    'id' => 'V03AF02',
                                                                    'text' => 'Dexrazoxane',
                                                                    'countProducts' => 1,
                                                                    'code' => 'V03AF02',
                                                                ),
                                                            2 =>
                                                                array (
                                                                    'id' => 'V03AF03',
                                                                    'text' => 'Calcium folinate',
                                                                    'countProducts' => 13,
                                                                    'code' => 'V03AF03',
                                                                ),
                                                            3 =>
                                                                array (
                                                                    'id' => 'V03AF04',
                                                                    'text' => 'Calcium levofolinate',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AF04',
                                                                ),
                                                            4 =>
                                                                array (
                                                                    'id' => 'V03AF05',
                                                                    'text' => 'Amifostine',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AF05',
                                                                ),
                                                            5 =>
                                                                array (
                                                                    'id' => 'V03AF06',
                                                                    'text' => 'Sodium folinate',
                                                                    'countProducts' => 7,
                                                                    'code' => 'V03AF06',
                                                                ),
                                                            6 =>
                                                                array (
                                                                    'id' => 'V03AF07',
                                                                    'text' => 'Rasburicase',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AF07',
                                                                ),
                                                            7 =>
                                                                array (
                                                                    'id' => 'V03AF08',
                                                                    'text' => 'Palifermin',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AF08',
                                                                ),
                                                            8 =>
                                                                array (
                                                                    'id' => 'V03AF09',
                                                                    'text' => 'Glucarpidase',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AF09',
                                                                ),
                                                            9 =>
                                                                array (
                                                                    'id' => 'V03AF10',
                                                                    'text' => 'Sodium levofolinate',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AF10',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                            5 =>
                                                array (
                                                    'id' => 'V03AG',
                                                    'text' => 'Препараты для лечения гиперкальциемии',
                                                    'countProducts' => 0,
                                                    'code' => 'V03AG',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V03AG01',
                                                                    'text' => 'Sodium cellulose phosphate',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AG01',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                            6 =>
                                                array (
                                                    'id' => 'V03AH',
                                                    'text' => 'Препараты для лечения гипогликемии',
                                                    'countProducts' => 0,
                                                    'code' => 'V03AH',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V03AH01',
                                                                    'text' => 'Diazoxide',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AH01',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                            7 =>
                                                array (
                                                    'id' => 'V03AK',
                                                    'text' => 'Тканевые повязки',
                                                    'countProducts' => 0,
                                                    'code' => 'V03AK',
                                                ),
                                            8 =>
                                                array (
                                                    'id' => 'V03AM',
                                                    'text' => 'Препараты для эмболизации',
                                                    'countProducts' => 0,
                                                    'code' => 'V03AM',
                                                ),
                                            9 =>
                                                array (
                                                    'id' => 'V03AN',
                                                    'text' => 'Медицинские газы',
                                                    'countProducts' => 0,
                                                    'code' => 'V03AN',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V03AN01',
                                                                    'text' => 'Oxygen',
                                                                    'countProducts' => 97,
                                                                    'code' => 'V03AN01',
                                                                ),
                                                            1 =>
                                                                array (
                                                                    'id' => 'V03AN02',
                                                                    'text' => 'Carbon dioxide',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AN02',
                                                                ),
                                                            2 =>
                                                                array (
                                                                    'id' => 'V03AN03',
                                                                    'text' => 'Helium',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AN03',
                                                                ),
                                                            3 =>
                                                                array (
                                                                    'id' => 'V03AN04',
                                                                    'text' => 'Nitrogen',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AN04',
                                                                ),
                                                            4 =>
                                                                array (
                                                                    'id' => 'V03AN05',
                                                                    'text' => 'Medical air',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AN05',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                            10 =>
                                                array (
                                                    'id' => 'V03AX',
                                                    'text' => 'Прочие лекарственные препараты',
                                                    'countProducts' => 196,
                                                    'code' => 'V03AX',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V03AX02',
                                                                    'text' => 'Nalfurafine',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AX02',
                                                                ),
                                                            1 =>
                                                                array (
                                                                    'id' => 'V03AX03',
                                                                    'text' => 'Cobicistat',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AX03',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                            11 =>
                                                array (
                                                    'id' => 'V03AZ',
                                                    'text' => 'Препараты, угнетающие нервную систему',
                                                    'countProducts' => 0,
                                                    'code' => 'V03AZ',
                                                    'children' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'id' => 'V03AZ01',
                                                                    'text' => 'Ethanol',
                                                                    'countProducts' => 0,
                                                                    'code' => 'V03AZ01',
                                                                ),
                                                        ),
                                                    'expanded' => false,
                                                ),
                                        ),
                                    'expanded' => false,
                                ),
                        ),
                    'expanded' => false,
                ),
        )
    ];

    recursivelyCreateAtx($arr);
});

