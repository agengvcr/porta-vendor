<?php
/**
 * Created by PhpStorm.
 * User: Wiljon
 * Date: 12/5/2018
 * Time: 10:07 AM
 */

namespace App\Libs;


class GlobalVar
{
	const VERSION = 'BETA v0.9.6';
	const TEST_USER_ID = 1;

    const TOKEN_LABEL = 'token';
    const USER_ID ='userId';
    const USER_NAME ='userName';
    const CLIENT_LOCATION_ID = 'clientLocationId';
    const CLIENT_ID = 'clientId';
    const NAME ='name';
    const CONTRACT_OR = 'contractOR';
    const CONTRACT_PRICE = 'contractPrice';
    const CLIENT_LOCATION_NAME = 'clientLocationName';
    const ROLE = 'role';
    const RECEIPT_OR ='receiptOR';
    const RECEIPT_MENU = 'receipt';
    const TAXRECEIPT_MENU = 'taxreceipt';
    const INVOICE_MENU = 'invoice';
    const CALLCENTER_FEEDBACK = 'callCenterFeedback';
    const GPS_HISTORY = 'GPSHistory';


    const LABELS = array(
    	'Service Berkala' => array(
    			'id' => '5a67e722088a7c7ab423d640',
    			'description' => 'Service Berkala Mobil setiap 10.000 Km (Passenger / Commercial) atau 5.000 Km (Commercial)'
		),
    	'SIPA / IBM / SIO' => array(
    			'id' => '5bf4b2c547e4060b68574677',
    			'description' => 'Perpanjangan dan pembuatan baru SIPA (Surat Izin Pengusaha Angkut) / IBM (Izin Bongkar Muat) / SIO (Surat Izin Operasional)'
    		),
    	'STNK' => array(
    			'id' => '5a682a683dc175ec14881bba',
    			'description' => 'Perpanjangan dan pengurusan kehilangan Surat Tanda Nomor Kendaraan'
    		),
    	'EMERGENCY' => array(
    			'id' => '5a668f129ae3d60b0cf45f9a',
    			'description' => 'Permintaan FAST RESPONSE (< 24 Hour)'
    		),
    	'UNIT HILANG' => array(
    			'id' => '5b91c5a5f2243a85ce0739e3',
    			'description' => 'Pelaporan kehilangan unit'
    		),
    	'Ban' => array(
    			'id' => '5a682a5dcbeef4cee2d6b6e9',
    			'description' => 'Permintaan pergantian ban'
    		),
    	'(KEUR) KIR' => array(
    			'id' => '5a682a6ff69f2c7b27cc02bb',
    			'description' => 'Perpanjangan dan pembuatan baru surat KEUR (KIR)'
    		),
    	'Accident' => array(
    			'id' => '5a6aa453cf611919d062279b',
    			'description' => 'Pelaporan dan permintaan mobil pegganti yang disebabkan oleh kecelakaan'
    		),
    	'Keluhan' => array(
    			'id' => '5a698e6ec7308b50a2d99d2f',
    			'description' => 'Pelaporan kondisi unit yang tidak normal (diluar service berkala)'
    		),
		'GPS' => array(
			'id' => '5e5e75d78ac7fa5dda37c7b7',
			'description' => 'Pelaporan unit yang terpasang GPS dengan status offline lebih dari 5 hari'
		),
    );
}