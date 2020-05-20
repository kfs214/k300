<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::table('animals')->insert([
        ['aname' => '長距離ランナーのチータ', 't12aname' => 'チータ', 't4code' => '3', 't3aname' => '太陽', 'rhythm' => '大樹', 'wangel' => '26', 'bdebil' => '56'],
        ['t12aname' => 'たぬき', 't4code' => '2', 'aname' => '社交家のたぬき', 'rhythm' => '草花', 't3aname' => '新月', 'wangel' => '37', 'bdebil' => '7'],
        ['t12aname' => '猿', 't4code' => '3', 'aname' => '落ち着きのない猿', 'rhythm' => '太陽', 't3aname' => '地球', 'wangel' => '48', 'bdebil' => '18'],
        ['t12aname' => '子守熊', 't4code' => '4', 'aname' => 'フットワークの軽い子守熊', 'rhythm' => '灯火', 't3aname' => '地球', 'wangel' => '59', 'bdebil' => '29'],
        ['t12aname' => '黒ひょう', 't4code' => '3', 'aname' => '面倒見のいい黒ひょう', 'rhythm' => '山岳', 't3aname' => '満月', 'wangel' => '10', 'bdebil' => '40'],
        ['t12aname' => '虎', 't4code' => '2', 'aname' => '愛情あふれる虎', 'rhythm' => '大地', 't3aname' => '地球', 'wangel' => '21', 'bdebil' => '51'],
        ['t12aname' => 'チータ', 't4code' => '3', 'aname' => '全力疾走するチータ', 'rhythm' => '鉱脈', 't3aname' => '太陽', 'wangel' => '32', 'bdebil' => '2'],
        ['t12aname' => 'たぬき', 't4code' => '2', 'aname' => '磨き上げられたたぬき', 'rhythm' => '宝石', 't3aname' => '新月', 'wangel' => '43', 'bdebil' => '13'],
        ['t12aname' => '猿', 't4code' => '3', 'aname' => '大きな志をもった猿', 'rhythm' => '海洋', 't3aname' => '地球', 'wangel' => '54', 'bdebil' => '24'],
        ['t12aname' => '子守熊', 't4code' => '4', 'aname' => '母性豊かな子守熊', 'rhythm' => '雨露', 't3aname' => '地球', 'wangel' => '5', 'bdebil' => '35'],
        ['t12aname' => 'こじか', 't4code' => '1', 'aname' => '正直なこじか', 'rhythm' => '大樹', 't3aname' => '新月', 'wangel' => '16', 'bdebil' => '46'],
        ['t12aname' => 'ゾウ', 't4code' => '4', 'aname' => '人気者のゾウ', 'rhythm' => '草花', 't3aname' => '太陽', 'wangel' => '27', 'bdebil' => '57'],
        ['t12aname' => '狼', 't4code' => '1', 'aname' => 'ネアカの狼', 'rhythm' => '太陽', 't3aname' => '地球', 'wangel' => '38', 'bdebil' => '8'],
        ['t12aname' => 'ひつじ', 't4code' => '4', 'aname' => '協調性のないひつじ', 'rhythm' => '灯火', 't3aname' => '満月', 'wangel' => '49', 'bdebil' => '19'],
        ['t12aname' => '猿', 't4code' => '3', 'aname' => 'どっしりとした猿', 'rhythm' => '山岳', 't3aname' => '地球', 'wangel' => '60', 'bdebil' => '30'],
        ['t12aname' => '子守熊', 't4code' => '4', 'aname' => 'コアラの中の子守熊', 'rhythm' => '大地', 't3aname' => '地球', 'wangel' => '11', 'bdebil' => '41'],
        ['t12aname' => 'こじか', 't4code' => '1', 'aname' => '強い意志をもったこじか', 'rhythm' => '鉱脈', 't3aname' => '新月', 'wangel' => '22', 'bdebil' => '52'],
        ['t12aname' => 'ゾウ', 't4code' => '4', 'aname' => 'デリケートなゾウ', 'rhythm' => '宝石', 't3aname' => '太陽', 'wangel' => '33', 'bdebil' => '3'],
        ['t12aname' => '狼', 't4code' => '1', 'aname' => '放浪の狼', 'rhythm' => '海洋', 't3aname' => '地球', 'wangel' => '44', 'bdebil' => '14'],
        ['t12aname' => 'ひつじ', 't4code' => '4', 'aname' => '物静かなひつじ', 'rhythm' => '雨露', 't3aname' => '満月', 'wangel' => '55', 'bdebil' => '25'],
        ['t12aname' => 'ペガサス', 't4code' => '1', 'aname' => '落ち着きのあるペガサス', 'rhythm' => '大樹', 't3aname' => '太陽', 'wangel' => '6', 'bdebil' => '36'],
        ['t12aname' => 'ペガサス', 't4code' => '1', 'aname' => '強靭な翼をもつペガサス', 'rhythm' => '草花', 't3aname' => '太陽', 'wangel' => '17', 'bdebil' => '47'],
        ['t12aname' => 'ひつじ', 't4code' => '4', 'aname' => '無邪気なひつじ', 'rhythm' => '太陽', 't3aname' => '満月', 'wangel' => '28', 'bdebil' => '58'],
        ['t12aname' => '狼', 't4code' => '1', 'aname' => 'クリエイティブな狼', 'rhythm' => '灯火', 't3aname' => '地球', 'wangel' => '39', 'bdebil' => '9'],
        ['t12aname' => '狼', 't4code' => '1', 'aname' => '穏やかな狼', 'rhythm' => '山岳', 't3aname' => '地球', 'wangel' => '50', 'bdebil' => '20'],
        ['t12aname' => 'ひつじ', 't4code' => '4', 'aname' => '粘り強いひつじ', 'rhythm' => '大地', 't3aname' => '満月', 'wangel' => '1', 'bdebil' => '31'],
        ['t12aname' => 'ペガサス', 't4code' => '1', 'aname' => '波乱に満ちたペガサス', 'rhythm' => '鉱脈', 't3aname' => '太陽', 'wangel' => '12', 'bdebil' => '42'],
        ['t12aname' => 'ペガサス', 't4code' => '1', 'aname' => '優雅なペガサス', 'rhythm' => '宝石', 't3aname' => '太陽', 'wangel' => '23', 'bdebil' => '53'],
        ['t12aname' => 'ひつじ', 't4code' => '4', 'aname' => 'チャレンジ精神旺盛なひつじ', 'rhythm' => '海洋', 't3aname' => '満月', 'wangel' => '34', 'bdebil' => '4'],
        ['t12aname' => '狼', 't4code' => '1', 'aname' => '順応性のある狼', 'rhythm' => '雨露', 't3aname' => '地球', 'wangel' => '45', 'bdebil' => '15'],
        ['t12aname' => 'ゾウ', 't4code' => '4', 'aname' => 'リーダーとなるゾウ', 'rhythm' => '大樹', 't3aname' => '太陽', 'wangel' => '56', 'bdebil' => '26'],
        ['t12aname' => 'こじか', 't4code' => '1', 'aname' => 'しっかり者のこじか', 'rhythm' => '草花', 't3aname' => '新月', 'wangel' => '7', 'bdebil' => '37'],
        ['t12aname' => '子守熊', 't4code' => '4', 'aname' => '活動的な子守熊', 'rhythm' => '太陽', 't3aname' => '地球', 'wangel' => '18', 'bdebil' => '48'],
        ['t12aname' => '猿', 't4code' => '3', 'aname' => '気分屋の猿', 'rhythm' => '灯火', 't3aname' => '地球', 'wangel' => '29', 'bdebil' => '59'],
        ['t12aname' => 'ひつじ', 't4code' => '4', 'aname' => '頼られると嬉しいひつじ', 'rhythm' => '山岳', 't3aname' => '満月', 'wangel' => '40', 'bdebil' => '10'],
        ['t12aname' => '狼', 't4code' => '1', 'aname' => '好感のもたれる狼', 'rhythm' => '大地', 't3aname' => '地球', 'wangel' => '51', 'bdebil' => '21'],
        ['t12aname' => 'ゾウ', 't4code' => '4', 'aname' => 'まっしぐらに突き進むゾウ', 'rhythm' => '鉱脈', 't3aname' => '太陽', 'wangel' => '2', 'bdebil' => '32'],
        ['t12aname' => 'こじか', 't4code' => '1', 'aname' => '華やかなこじか', 'rhythm' => '宝石', 't3aname' => '新月', 'wangel' => '13', 'bdebil' => '43'],
        ['t12aname' => '子守熊', 't4code' => '4', 'aname' => '夢とロマンの子守熊', 'rhythm' => '海洋', 't3aname' => '地球', 'wangel' => '24', 'bdebil' => '54'],
        ['t12aname' => '猿', 't4code' => '3', 'aname' => '尽くす猿', 'rhythm' => '雨露', 't3aname' => '地球', 'wangel' => '35', 'bdebil' => '5'],
        ['t12aname' => 'たぬき', 't4code' => '2', 'aname' => '大器晩成のたぬき', 'rhythm' => '大樹', 't3aname' => '新月', 'wangel' => '46', 'bdebil' => '16'],
        ['t12aname' => 'チータ', 't4code' => '3', 'aname' => '足腰の強いチータ', 'rhythm' => '草花', 't3aname' => '太陽', 'wangel' => '57', 'bdebil' => '27'],
        ['t12aname' => '虎', 't4code' => '2', 'aname' => '動きまわる虎', 'rhythm' => '太陽', 't3aname' => '地球', 'wangel' => '8', 'bdebil' => '38'],
        ['t12aname' => '黒ひょう', 't4code' => '3', 'aname' => '情熱的な黒ひょう', 'rhythm' => '灯火', 't3aname' => '満月', 'wangel' => '19', 'bdebil' => '49'],
        ['t12aname' => '子守熊', 't4code' => '4', 'aname' => 'サービス精神旺盛な子守熊', 'rhythm' => '山岳', 't3aname' => '地球', 'wangel' => '30', 'bdebil' => '60'],
        ['t12aname' => '猿', 't4code' => '3', 'aname' => '守りの猿', 'rhythm' => '大地', 't3aname' => '地球', 'wangel' => '41', 'bdebil' => '11'],
        ['t12aname' => 'たぬき', 't4code' => '2', 'aname' => '人間味あふれるたぬき', 'rhythm' => '鉱脈', 't3aname' => '新月', 'wangel' => '52', 'bdebil' => '22'],
        ['t12aname' => 'チータ', 't4code' => '3', 'aname' => '品格のあるチータ', 'rhythm' => '宝石', 't3aname' => '太陽', 'wangel' => '3', 'bdebil' => '33'],
        ['t12aname' => '虎', 't4code' => '2', 'aname' => 'ゆったりとした悠然の虎', 'rhythm' => '海洋', 't3aname' => '地球', 'wangel' => '14', 'bdebil' => '44'],
        ['t12aname' => '黒ひょう', 't4code' => '3', 'aname' => '落ち込みの激しい黒ひょう', 'rhythm' => '雨露', 't3aname' => '満月', 'wangel' => '25', 'bdebil' => '55'],
        ['t12aname' => 'ライオン', 't4code' => '2', 'aname' => '我が道を行くライオン', 'rhythm' => '大樹', 't3aname' => '太陽', 'wangel' => '36', 'bdebil' => '6'],
        ['t12aname' => 'ライオン', 't4code' => '2', 'aname' => '統率力のあるライオン', 'rhythm' => '草花', 't3aname' => '太陽', 'wangel' => '47', 'bdebil' => '17'],
        ['t12aname' => '黒ひょう', 't4code' => '3', 'aname' => '感情豊かな黒ひょう', 'rhythm' => '太陽', 't3aname' => '満月', 'wangel' => '58', 'bdebil' => '28'],
        ['t12aname' => '虎', 't4code' => '2', 'aname' => '楽天的な虎', 'rhythm' => '灯火', 't3aname' => '地球', 'wangel' => '9', 'bdebil' => '39'],
        ['t12aname' => '虎', 't4code' => '2', 'aname' => 'パワフルな虎', 'rhythm' => '山岳', 't3aname' => '地球', 'wangel' => '20', 'bdebil' => '50'],
        ['t12aname' => '黒ひょう', 't4code' => '3', 'aname' => '気どらない黒ひょう', 'rhythm' => '大地', 't3aname' => '満月', 'wangel' => '31', 'bdebil' => '1'],
        ['t12aname' => 'ライオン', 't4code' => '2', 'aname' => '感情的なライオン', 'rhythm' => '鉱脈', 't3aname' => '太陽', 'wangel' => '42', 'bdebil' => '12'],
        ['t12aname' => 'ライオン', 't4code' => '2', 'aname' => '傷つきやすいライオン', 'rhythm' => '宝石', 't3aname' => '太陽', 'wangel' => '53', 'bdebil' => '23'],
        ['t12aname' => '黒ひょう', 't4code' => '3', 'aname' => '束縛を嫌う黒ひょう', 'rhythm' => '海洋', 't3aname' => '満月', 'wangel' => '4', 'bdebil' => '34'],
        ['aname' => '慈悲深い虎', 't12aname' => '虎', 't4code' => '2', 't3aname' => '地球', 'rhythm' => '雨露', 'wangel' => '15', 'bdebil' => '45'],
      ]);

/*        Schema::create('gnames', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('code');  //group_code 12xx 03xx 10xx
          $table->string('name');  //group_name
      });

      DB::table('gnames')->insert([
        ['code' => '1201', 'name' => 'ペガサス'],
        ['code' => '1202', 'name' => '狼'],
        ['code' => '1203', 'name' => 'こじか'],
        ['code' => '1204', 'name' => '猿'],
        ['code' => '1205', 'name' => 'チータ'],
        ['code' => '1206', 'name' => '黒ひょう'],
        ['code' => '1207', 'name' => 'ライオン'],
        ['code' => '1208', 'name' => '虎'],
        ['code' => '1209', 'name' => 'たぬき'],
        ['code' => '1210', 'name' => '子守熊'],
        ['code' => '1211', 'name' => 'ゾウ'],
        ['code' => '1212', 'name' => 'ひつじ'],

        ['code' => '0301', 'name' => '太陽'],
        ['code' => '0302', 'name' => '地球'],
        ['code' => '0303', 'name' => '月'],

        ['code' => '1001', 'name' => '大樹'],
        ['code' => '1002', 'name' => '草花'],
        ['code' => '1003', 'name' => '太陽'],
        ['code' => '1004', 'name' => '灯火'],
        ['code' => '1005', 'name' => '山岳'],
        ['code' => '1006', 'name' => '大地'],
        ['code' => '1007', 'name' => '鉱脈'],
        ['code' => '1008', 'name' => '宝石'],
        ['code' => '1009', 'name' => '海洋'],
        ['code' => '1010', 'name' => '雨露'],
      ]); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
