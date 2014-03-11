<?php

// Import ImageWorkshop 
require_once 'ImageWorkshop.php';

// Import ImageWorkshopExceptionExtension for execption Handling
require_once(__DIR__.'/Exception/ImageWorkshopExceptionExtension.php');

// Import to Add Fillter for effect
require_once(__DIR__.'/Core/InstagraphEffect.php');

/**
 * ImageWorkShopExtension for yii
 *
 * @package    ImageWorkshopException
 * @author     Softobiz Developer <dm@php.net>
 * @copyright  Softobiz
 * @license    GNU GPL
 */

class ImageWorkshopExtension 
{
	public $imagePost  		= null;
	public $imageSize	 	= null;
	public $imageImagePath	= null;
	public $imageRandom     = null;
	public $imageCreate     = array();
	public $imageUrlNe      = null;
	public $imageOutputSize = array();
	public $counter			= 1;

	public function __construct($setting)
	{
		if(!is_array($setting))
		{
			throw new ImageWorkshopExceptionExtension("Argument Must be an array");
		}
	
		foreach($setting as $key=>$value)
		{
			$temp = $value;
			switch ($key) {
				case 'Post':
					$this->imagePost = $temp ;
				break;
			
				case 'Size':
					$this->imageSize = $temp ;
				break;
			
				case 'ImagePath':
					$this->imageImagePath = $temp ;
				break;
	
			}
			
		} 
		
		$this->imageRandom = $this->randomStringFunction(12);
	
/* 		if(!empty($this->imagePost['wrapView']))
		{
			$result = $this->wrapView($this->imagePost['wrapView']);
			return $result;
			
			die;
		}
 		
		$this->createLayout($this->imagePost['layout']);
*/		
		//return $this->createLayout($this->imagePost['layout']);
	}
	
	function wrapViewMy()
	{
		$result = $this->wrapView($this->imagePost['wrapView']);
		return $result;
	}
	
	function createLayoutMy()
	{

		if($this->imagePost['layout'] == 4 )
		{
			$this->createLayoutWrapGalleryPdf($this->imagePost['layout']);
		}else{
			$this->createLayout($this->imagePost['layout']);
		}
	}
	
	function createLayout($layout = 1)
	{
		
		if($this->imagePost['effect_id']){

			$urlEffect = 'effectIMp'.$this->imageRandom.'.jpg';
			$layoutEffect = ImageWorkshop::initFromPath($this->imageImagePath['base'].'cropped/'.$this->imagePost['image']);
			$layoutEffect->save($this->imageImagePath['save'],$urlEffect ,true,null,100);
			
			$layoutEffect->save($this->imageImagePath['save'],'effect'.$urlEffect ,true,null,100);
			
			$pathurlNewMy = $this->imageImagePath['save'].'/'.$urlEffect;
			$pathurlNewMyE = $this->imageImagePath['save'].'/effect'.$urlEffect;
			
			//$pathurlNewMyE = '/var/betawebsites/pixelpaint/pixelpaint/siteupload/bc/effect'.$urlEffect;
			
			$pathurlNewMyES = $this->imageImagePath['save'].'/effectSave'.$urlEffect;
			
			if($this->addEffectToImage($pathurlNewMy, $pathurlNewMyE,$pathurlNewMyE)){
				$layoutLayer = ImageWorkshop::initFromPath($pathurlNewMyE);
			}else{
				throw new ImageWorkshopExceptionExtension("Effect not done");
			}
			
		}else{
			
			$layoutLayer = ImageWorkshop::initFromPath($this->imageImagePath['base'].'cropped/'.$this->imagePost['image']);
		
		}
		
		extract($this->positionFormatPdf());

		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
		
		array($widthRatio*96,$heightRatio*96,false,0,0,'MM');
		
		$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
		
		
		switch ($layout) {
		
			case 1:
				
/* 				list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =

				array($this->imageSize['width']*96,$this->imageSize['height']*96,false,0,0,'MM');
				
				$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
 */				
				$urlNew = 'layoutone'.$this->imageRandom.'.png';
				
				$this->imageCreate['layoutone'] = "/siteupload/bc/$urlNew";
				
				$urlNewWrap = 'Wrap'.$urlNew;
				
				$dataImage = $this->finaloutput($layoutLayer,$urlNewWrap);
				
				$this->printpdfNew($dataImage['pdfwidth'], $dataImage['pdfheight'], 'SingleLayout', $dataImage['imageUrlNe']);
		
				
				break;
		
			case 2:
		
/* 				list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
				
				array($this->imageSize['width']*96,$this->imageSize['height']*96,false,0,0,'MM');
				
				$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
 */				
				$layoutLayerLeft = clone $layoutLayer;
				$layoutLayerRight = clone $layoutLayer;
				
				$layoutLayerLeft->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight(),0,0,'LT');
				$layoutLayerRight->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight(),0,0,'RT');
				
				$layoutLayerLeft->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRight->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				
				$urlNewLeft = 'layoutleft'.$this->imageRandom.'.png';
				$urlNewRight = 'layoutright'.$this->imageRandom.'.png';
				
				$urlNewWrapLeft = 'WrapLeft'.$urlNewLeft;
				
				$dataImages[] = $this->finaloutput($layoutLayerLeft,$urlNewWrapLeft);
				
				$urlNewWrapRight = 'WrapRight'.$urlNewRight;
				
				$dataImages[] = $this->finaloutput($layoutLayerRight,$urlNewWrapRight);
				
				$this->printpdfNew($dataImages[0]['pdfwidth'], $dataImages[0]['pdfheight'], 'SecondLayout', $dataImages[0]['imageUrlNe'].$dataImages[1]['imageUrlNe']);

				
				break;
		
			case 3:

// 				list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
				
// 				array($this->imageSize['width']*96,$this->imageSize['height']*96,false,0,0,'MM');
				
// 				$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$layoutLayerLeft = clone $layoutLayer;
				$layoutLayerMiddle = clone $layoutLayer;
				$layoutLayerRight = clone $layoutLayer;
				
				$middlecut = $layoutLayer->getWidth()/3 ;
				
				$layoutLayerLeft->cropInPixel($middlecut,$layoutLayer->getHeight(),0,0,'LT');
				$layoutLayerMiddle->cropInPixel($middlecut,$layoutLayer->getHeight(),$middlecut,0,'LT');
				$layoutLayerRight->cropInPixel($middlecut,$layoutLayer->getHeight(),$middlecut*2,0,'LT');
				
				$layoutLayerLeft->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerMiddle->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRight->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$urlNewLeft   = 'layoutleft'.$this->imageRandom.'.png';
				$urlNewMiddle = 'layoutmiddle'.$this->imageRandom.'.png';
				$urlNewRight  = 'layoutright'.$this->imageRandom.'.png';
				
				$urlNewWrapLeft = 'WrapLeft'.$urlNewLeft;
				
				$dataImages[] = $this->finaloutput($layoutLayerLeft,$urlNewWrapLeft);
				
				$urlNewWrapMiddle = 'WrapRight'.$urlNewMiddle;
				
				$dataImages[] = $this->finaloutput($layoutLayerMiddle,$urlNewWrapMiddle);
				
				$urlNewWrapRight = 'WrapRight'.$urlNewRight;
				
				$dataImages[] = $this->finaloutput($layoutLayerRight,$urlNewWrapRight);
				
				$this->printpdfNew($dataImages[0]['pdfwidth'], 
								   $dataImages[0]['pdfheight'],
								  'ThirdLayout', 
								  $dataImages[0]['imageUrlNe'].$dataImages[1]['imageUrlNe'].$dataImages[2]['imageUrlNe']);
				
				break;
						
			case 4:
		
// 				list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
				
// 				array($this->imageSize['width']*96,$this->imageSize['height']*96,false,0,0,'MM');
				
// 				$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$layoutLayerLeftTop 	= clone $layoutLayer;
				$layoutLayerLeftBottom 	= clone $layoutLayer;
				$layoutLayerRightTop 	= clone $layoutLayer;
				$layoutLayerRightBottom = clone $layoutLayer;
				
				$urlNewLeftTop   = 'layoutLeftTop'.$this->imageRandom.'.png';
				$urlNewLeftBottom = 'layoutLeftBottom'.$this->imageRandom.'.png';
				$urlNewRightTop  = 'layoutRightTop'.$this->imageRandom.'.png';
				$urlNewRightBottom  = 'layoutRightBottom'.$this->imageRandom.'.png';
				
				$urlNewWrapLeftTop 		= 'WrapLeftTop'.$urlNewLeftTop;
				$urlNewWrapLeftBottom 	= 'WrapLeftBottom'.$urlNewLeftBottom;
				$urlNewWrapRightTop 	= 'WrapRightTop'.$urlNewRightTop;
				$urlNewWrapRightBottom 	= 'WrapRightBottom'.$urlNewRightBottom;
				
				/* LEFT TOP */
				
				$layoutLayerLeftTop->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'LT');
				
				$layoutLayerLeftTop->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$dataImages[] = $this->finaloutput($layoutLayerLeftTop,$urlNewWrapLeftTop);
				
				/* RIGHT TOP */
				
				$layoutLayerRightTop->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'RT');
				
				$layoutLayerRightTop->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
					
				$dataImages[] = $this->finaloutput($layoutLayerRightTop,$urlNewWrapRightTop);
				
				/* LEFT BOTTOM */
				
				$layoutLayerLeftBottom->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'LB');
				
				$layoutLayerLeftBottom->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$dataImages[] = $this->finaloutput($layoutLayerLeftBottom,$urlNewWrapLeftBottom);
				
				/* RIGHT BOTTOM */
				
				$layoutLayerRightBottom->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'RB');

				$layoutLayerRightBottom->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$dataImages[] = $this->finaloutput($layoutLayerRightBottom,$urlNewWrapRightBottom);
				
				/* FINAL PDF */
				
				$this->printpdfNew($dataImages[0]['pdfwidth'],
						$dataImages[0]['pdfheight'],
						'FourthLayout',
						$dataImages[0]['imageUrlNe'].$dataImages[1]['imageUrlNe'].$dataImages[2]['imageUrlNe'].$dataImages[3]['imageUrlNe']);
				
				break;
						
		
		}
	}
	

	
	public function finaloutput($imageUrlPerform,$nameImg)
	{

		$siteUrlMain = $this->imageImagePath['baseUrl'];
		
		$pinguLayer = clone $imageUrlPerform;
		
		
		$pinguLayer->save($this->imageImagePath['save'],'Amrit'.$this->imageRandom.'.png' , true, null, 95);
		
		$amritSavePixel = $this->imageImagePath['save'].'/Amrit'.$this->imageRandom.'.png' ; 
		
		$amritPixelStretch =  $this->pixelStretch($amritSavePixel, $pinguLayer->getWidth(), $pinguLayer->getHeight());
		
		$creatImageAmritTop = ImageWorkshop::initFromResourceVar($amritPixelStretch['top']);
		
		$creatImageAmritBottom = ImageWorkshop::initFromResourceVar($amritPixelStretch['bottom']);
		
		$creatImageAmritLeft = ImageWorkshop::initFromResourceVar($amritPixelStretch['left']);
		
		$creatImageAmritRight = ImageWorkshop::initFromResourceVar($amritPixelStretch['right']);
		
		
		switch ($this->imagePost['wrap_type']) {

			default:
				list($backgroundColor, $backgroundCornerColor ) = array('11dd66','FFFFFF') ;
				break;
		
		
		}
		
		if($this->imagePost['wrap_type'] == 1){
			
			$backgroundColor = '000000';
			
		}else{
			
			$backgroundColor = 'FFFFFF';
		}
		
		$barcodeData = $this->barcodeGenaration();
		
		$groupBarcode = ImageWorkshop::initFromPath($barcodeData);
		
				
		$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+288,$pinguLayer->getHeight()+288,$backgroundColor);
		
		$groupNew = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+520,$pinguLayer->getHeight()+520,'f1f1f1');
		
		$pinguLayerTop 		= clone $pinguLayer;
		$pinguLayerRight 	= clone $pinguLayer;
		$pinguLayerBottom 	= clone $pinguLayer;
		$pinguLayerLeft		= clone $pinguLayer;
		
		$pinguLayerTop->cropInPixel($pinguLayer->getWidth(),144,0,0,'LT');
		$pinguLayerRight->cropInPixel(144,$pinguLayer->getHeight(),0,0,'RT');
		$pinguLayerBottom->cropInPixel($pinguLayer->getWidth(),144,0,0,'RB');
		$pinguLayerLeft->cropInPixel(144,$pinguLayer->getHeight(),0,0,'LB');
		
		switch ($this->imagePost['wrap_type']) {
			
			case 1:
				
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
				
				$group->addLayerOnTop($pinguLayer, 144, 144, 'LT');
				
				break;
			
			case 2:
				
				list($backgroundColor, $backgroundCornerColor ) = array('FFFFFF','000000') ;
				
				$group->addLayerOnTop($pinguLayer, 144, 144, 'LT');
				
				break;
		
			case 3:
				
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
				
				$group->addLayerOnTop($creatImageAmritTop,144,0,'LT');
				$group->addLayerOnTop($creatImageAmritBottom,144,0,'LB');
				$group->addLayerOnTop($creatImageAmritLeft,0,144,'LT');
				$group->addLayerOnTop($creatImageAmritRight,0,144,'RT');
				
				$group->addLayerOnTop($pinguLayer, 144, 144, 'LT');
				
				$groupNew->addLayerOnTop($group,110,110,'LT');
				
				break;
		
			case 4:
				
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
				
				list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
				
				array($pinguLayer->getWidth()+288,$pinguLayer->getHeight()+288,false,0,0,'MM');
				
				$pinguLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
			    
				$group->addLayerOnTop($pinguLayer, 0, 0, 'LT');
				
				$groupNew->addLayerOnTop($group,110,110,'LT');
		
				break;
		
			case 5:
				
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
				
				$group->addLayerOnTop($pinguLayer, 144, 144, 'LT');
				
				$pinguLayerTop->flip('vertical');
				$pinguLayerRight->flip('horizontal') ;
				$pinguLayerBottom->flip('vertical');
				$pinguLayerLeft->flip('horizontal') ;
				
				
				$group->addLayerOnTop($pinguLayerTop,144,0,'LT');
				$group->addLayerOnTop($pinguLayerRight,0,144,'RT');
				$group->addLayerOnTop($pinguLayerBottom,144,0,'RB');
				$group->addLayerOnTop($pinguLayerLeft,0,144,'LB');
				$groupNew->addLayerOnTop($group,110,110,'LT');
				
				break;
		
			default:
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
				break;
		
		
		}
		
		$this->addCorner($backgroundCornerColor, $group);
		
		/* Add image canvas to main canvas */
		
		$groupNew->addLayerOnTop($group,110,110,'LT');
		
		/* Add barcode to main canvas */
		
		$groupNew->addLayerOnTop($groupBarcode, 0, 0, 'MT');
		$groupNew->addLayerOnTop($groupBarcode, 0, 10, 'MB');
		
		/* Add register mark to main */
		
		$amreg = $this->addRegistrationMark();
		
		$groupNew->addLayerOnTop($amreg, 55, 0, 'LM');
		$groupNew->addLayerOnTop($amreg, 66, 0, 'RM');
		$groupNew->addLayerOnTop($amreg, 0, 55, 'MT');
		$groupNew->addLayerOnTop($amreg, 0, 66, 'MB');
		
		$imageUrlNe = '';

		$groupNew->save($this->imageImagePath['save'],$nameImg , true, null, 100);
		$imageUrlNe .=    "<img src='$siteUrlMain/siteupload/bc/$nameImg' ></img>";
		
		$this->imageCreate['layout_1']['single'] = "/siteupload/bc/$nameImg";
		
		
		list($pdfHeight,$pdfWidth,$imageUrl) = array($groupNew->getHeight()*0.27,
				$groupNew->getWidth()*0.27,
				$imageUrlNe);
		
		$this->imageUrlNe = $imageUrlNe;
		
		$this->imageOutputSize['pdfwidth']  = $groupNew->getWidth()*0.27;
		$this->imageOutputSize['pdfheight']	= $groupNew->getHeight()*0.27;
		
		return array('pdfwidth'		 =>	$groupNew->getWidth()*0.27,
					 'pdfheight'	 =>	$groupNew->getHeight()*0.27,
					 'imageCreated'	 =>	$this->imageCreate,
				     'barcodestring' => 'barcode'.$this->imageRandom,
					 'imageUrlNe'    => $imageUrlNe
					);
		
	}
	
	public function printpdf()
	{
		$mPDF1 = Yii::app()->ePdf->mpdf();
		
		$ams = 'P';
		$mPDF1->_setPageSize(array($this->imageOutputSize['pdfwidth'],$this->imageOutputSize['pdfheight']),$ams);
		
		$mPDF1->WriteHTML($this->imageUrlNe);
		
		$invoicepath = $this->imageImagePath['save'];
		
		$mPDF1->Output();
		
		
	}
	
	public function printpdfNew($width,$height,$name,$data)
	{
		$mPDF1 = Yii::app()->ePdf->mpdf();
	
		$ams = 'P';
		
		$mPDF1->_setPageSize(array($width,$height),$ams);
	
		$mPDF1->WriteHTML($data);
	
		$invoicepath = $this->imageImagePath['save'];
	
		$mPDF1->Output($invoicepath.'invoice'.$name.$this->imageRandom.'.pdf','F');
	
		$mPDF1->Output();
	
	
	}
	
	public function pr($arg)
	{
		printf("<pre>%s</pre>",print_r($arg,true));
	}
	
	/* Function: Random String
	 * @params : $strlength variable for the length for string
	 * @return : random string for given length
	 * 
	 */
	private function randomStringFunction($strlength)
	{
		$word = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,1,2,3,4,5,6,7,8,9,0";
		
		$array=explode(",",$word);
		
		shuffle($array);
		
		$newstring = implode($array,"");
		
		return substr($newstring, 0, $strlength);
		
	}

	/* Function: Barcode Genaration
	 * @params : no-params
	 * @return : string which has the path for genrated barcode on server
	 * 
	 * @comment: We use Yii extensions barcode for genrate the image.
	 *
	 */
	
	private function barcodeGenaration()
	{
		$width  = 400;
		
		$height = 50;
		
		$quality = 100;
		
		Yii::import("application.extensions.barcode.*");
		
		$ranndomString = 'barcode'.$this->imageRandom;
		
		$location = $this->imageImagePath['save']."{$ranndomString}.png";
		
		$text =1;
		
		barcode::Barcode39($ranndomString, $width , $height , $quality, $text, $location);
		
		return $location;
		
	}
	
	/* Function: Add Corner
	 * @params : $cornerColor - This variable used for the color of the corner for main canvas  
	 * 			 ImageWorkshopLayer $imageCorner - This is the object of current canvas layer ( ImageWorkshopLayer ) 
	 * @return : Add corner to main canvas layer for image.
	 *
	 */	
	
	private function addCorner($cornerColor, ImageWorkshopLayer $imageCorner)
	{
		$groupTransparent = ImageWorkshop::initVirginLayer(144,144,$cornerColor);
		
		$imageCorner->addLayerOnTop($groupTransparent, 0, 0, 'LT');
		$imageCorner->addLayerOnTop($groupTransparent, 0, 0, 'LB');
		$imageCorner->addLayerOnTop($groupTransparent, 0, 0, 'RT');
		$imageCorner->addLayerOnTop($groupTransparent, 0, 0, 'RB');
	}

	
	/* Function: Pixel Stretch
	 * @params : $imageSource -path the image on which task is perform 
	 * 			 $width  -width for the image
	 * 			 $height -height of the image
	 * @return : return the array of the pixelStretch for top bottom left right of image
	 *
	 */
	
	private function pixelStretch($imageSource,$width,$height)
	{
		$im = imagecreatefrompng($imageSource);
		
		$size = array();
		$size['width'] = $width;
		$size['height'] = $height;
		 
		$imss = array();
		
		$imss['top'] = $this->pixelstretchcreate($im, $size, 'TOP');
		
		$imss['bottom'] = $this->pixelstretchcreate($im, $size, 'BOTTOM');
		
		$imss['left'] = $this->pixelstretchcreate($im, $size, 'LEFT');
		
		$imss['right'] = $this->pixelstretchcreate($im, $size, 'RIGHT');
		
		return $imss;
	}
	
	/* Function: Pixel Stretch Create
	 * @params : $imsource -path the image on which task is perform
	 * 			 $size array which contain height and width
	 * 			 $side side for image for which pixel stretch perform
	 * @return : return gd image resource vairable 
	 *
	 */

	public function pixelstretchcreate($imsource,$size,$side)
	{
			
		
		switch ($side) {
			case 'TOP':
				
				$imss = imagecreate($size['width'], 144);
				
				$start_y = 0;
				
				$imageInde = array();
				
				for($start_x = 0 ; $start_x < $size['width']; $start_x++ )
				{
				
					$color_index = imagecolorat($imsource, $start_x ,$start_y);
				
					$imageInde[$start_x] =  imagecolorsforindex($imsource, $color_index);
				
					$mycolorline = imagecolorallocate ( $imss ,$imageInde[$start_x]['red'] , $imageInde[$start_x]['green'] , $imageInde[$start_x]['blue'] );
				
					imageline ( $imss , $start_x , 0  , $start_x , 144  , $color_index );
				}
				
				return $imss;
				
			break;
			
			case 'BOTTOM':
				
				$imss = imagecreate($size['width'], 144);
				
				$start_y = $size['height']-1;
				
				$imageInde = array();
				
				for($start_x = 0 ; $start_x < $size['width']; $start_x++ )
				{
				
					$color_index = imagecolorat($imsource, $start_x ,$start_y);
				
					$imageInde[$start_x] =  imagecolorsforindex($imsource, $color_index);
				
					$mycolorline = imagecolorallocate ( $imss ,$imageInde[$start_x]['red'] , $imageInde[$start_x]['green'] , $imageInde[$start_x]['blue'] );
				
					imageline ( $imss , $start_x , 0  , $start_x , 144  , $color_index );
				}
				
				return $imss;
				
			break;
			
			case 'LEFT':
				
				$imss = imagecreate(144, $size['height']);
				
				$start_x = 0;
				
				$imageInde = array();
				
				for($start_y = 0 ; $start_y <$size['height']; $start_y++ )
				{
				
					$color_index = imagecolorat($imsource, $start_x ,$start_y);
				
					$imageInde[$start_y] =  imagecolorsforindex($imsource, $color_index);
				
					$mycolorline = imagecolorallocate ( $imss ,$imageInde[$start_y]['red'] , $imageInde[$start_y]['green'] , $imageInde[$start_y]['blue'] );
				
					imageline ( $imss , 0 , $start_y  , 144 , $start_y  , $color_index );
				}
				
				return $imss;
				
			break;
		
			case 'RIGHT':
				
				$imss = imagecreate(144, $size['height']);
				
				$start_x = $size['width'] - 1;
				
				$imageInde = array();
				
				for($start_y = 0 ; $start_y < $size['height']; $start_y++ )
				{
				
					$color_index = imagecolorat($imsource, $start_x ,$start_y);
				
					$imageInde[$start_y] =  imagecolorsforindex($imsource, $color_index);
				
					$mycolorline = imagecolorallocate ( $imss ,$imageInde[$start_y]['red'] , $imageInde[$start_y]['green'] , $imageInde[$start_y]['blue'] );
				
					imageline ( $imss , 0 , $start_y  , 144 , $start_y  , $color_index );
				}
				
				return $imss;
			break;
			
			
		}
		

	}
	
	private function addRegistrationMark()
	{
		$regMark  =  ImageWorkshop::initFromPath($this->imageImagePath['base'].'/../../images/regmark.jpg');
		
		return $regMark;
		
	}
	
	private function addEffectToImage($input,$output,$path=null,$method='Toaster')
	{
		
		$instagraph = new InstagraphEffect;
		
		$instagraph->setInput($input);
			
		$instagraph->setOutput($output);
		
		$instagraph->setTempPath($path);
		

		if($instagraph->process($method)){
			return true;
		}else{
			return false;
		}
		
	}
	
	public function wrapView()
	{

/* 		$layoutEffect = ImageWorkshop::initFromPath($this->imageImagePath['base'].'cropped/'.$this->imagePost['wrapView']);

		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
		
		array(500,270,false,0,0,'MM');
		
		$layoutEffect->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
		
		$urlNew = 'View'.$this->imageRandom.'.jpg';
		
		$result = $this->finaloutputWrapView($layoutEffect, $urlNew);
		
		
 */
		if($this->imagePost['wrap_type'] == 4){
			$result = $this->createLayoutWrapGallery($this->imagePost['layout']);
		}else{
			$result = $this->createLayoutWrap($this->imagePost['layout']);
		}
		
		//$result = $this->createLayoutWrap($this->imagePost['layout']);
		
		
				
		return $result;
	}
	
	
	public function finaloutputWrapView($imageUrlPerform,$nameImg)
	{
	

		$siteUrlMain = $this->imageImagePath['baseUrl'];
	
		$pinguLayer = clone $imageUrlPerform;
	
		$pinguLayer->save($this->imageImagePath['save'],'ViewWrap'.$this->imageRandom.'.jpg' , true, null, 95);
	
		$amritSavePixel = $this->imageImagePath['save'].'/ViewWrap'.$this->imageRandom.'.jpg' ;
	
	
		switch ($this->imagePost['wrap_type']) {
	
			default:
				list($backgroundColor, $backgroundCornerColor ) = array('11dd66','FFFFFF') ;
				break;
		}
	
		if($this->imagePost['wrap_type'] == 1){
				
			$backgroundColor = '000000';
				
		}else{
				
			$backgroundColor = 'FFFFFF';
		}
	
		$barcodeData = $this->barcodeGenaration();
	
		$groupBarcode = ImageWorkshop::initFromPath($barcodeData);
	
		$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+80,$pinguLayer->getHeight()+86,$backgroundColor);
	
		$pinguLayerTop 		= clone $pinguLayer;
		$pinguLayerRight 	= clone $pinguLayer;
		$pinguLayerBottom 	= clone $pinguLayer;
		$pinguLayerLeft		= clone $pinguLayer;
	
		$pinguLayerTop->cropInPixel($pinguLayer->getWidth(),46,0,0,'LT');
		$pinguLayerRight->cropInPixel(40,$pinguLayer->getHeight(),0,0,'RT');
		$pinguLayerBottom->cropInPixel($pinguLayer->getWidth(),40,0,0,'RB');
		$pinguLayerLeft->cropInPixel(40,$pinguLayer->getHeight(),0,0,'LB');
	
		switch ($this->imagePost['wrap_type']) {
				
			case 1:
	
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
	
				$group->addLayerOnTop($pinguLayer, 40, 46, 'LT');
	
				break;
					
			case 2:
	
				list($backgroundColor, $backgroundCornerColor ) = array('FFFFFF','000000') ;
	
				$group->addLayerOnTop($pinguLayer, 40, 46, 'LT');
	
				break;
	
			case 3:
	
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
	
				$amritPixelStretch =  $this->pixelStretchWrap($amritSavePixel, $pinguLayer->getWidth(), $pinguLayer->getHeight());
				
				$creatImageAmritTop = ImageWorkshop::initFromResourceVar($amritPixelStretch['top']);
				
				$creatImageAmritBottom = ImageWorkshop::initFromResourceVar($amritPixelStretch['bottom']);
				
				$creatImageAmritLeft = ImageWorkshop::initFromResourceVar($amritPixelStretch['left']);
				
				$creatImageAmritRight = ImageWorkshop::initFromResourceVar($amritPixelStretch['right']);
				
				$group->addLayerOnTop($creatImageAmritTop,40,0,'LT');
				$group->addLayerOnTop($creatImageAmritBottom,40,0,'LB');
				$group->addLayerOnTop($creatImageAmritLeft,0,46,'LT');
				$group->addLayerOnTop($creatImageAmritRight,0,46,'RT');
	
				$group->addLayerOnTop($pinguLayer, 40, 46, 'LT');
	
	
				break;
	
			case 4:
	
//				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
//				$group->addLayerOnTop($pinguLayer, 0, 0, 'LT');

//				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
					
//				list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
					
//				array($pinguLayer->getWidth()+80,$pinguLayer->getHeight()+86,false,0,0,'MM');
					
//				$pinguLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
//				$group->addLayerOnTop($pinguLayer, 0, 0, 'LT');
	
				break;
	
			case 5:
	
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
	
				$group->addLayerOnTop($pinguLayer, 40, 46, 'LT');
	
				$pinguLayerTop->flip('vertical');
				$pinguLayerRight->flip('horizontal') ;
				$pinguLayerBottom->flip('vertical');
				$pinguLayerLeft->flip('horizontal') ;
	
	
				$group->addLayerOnTop($pinguLayerTop,40,0,'LT');
				$group->addLayerOnTop($pinguLayerRight,0,46,'RT');
				$group->addLayerOnTop($pinguLayerBottom,40,0,'RB');
				$group->addLayerOnTop($pinguLayerLeft,0,40,'LB');
				
	
				break;
	
			default:
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
				break;
	
	
		}
	
		$this->addCornerWrap($backgroundCornerColor, $group);
	
		$imageUrlNe = '';
		
		$group->save($this->imageImagePath['save'],'/tmp/'.$nameImg , true, null, 100);
		$imageUrlNe .=    "<img src='$siteUrlMain/siteupload/bc/tmp/$nameImg' ></img>";
	
		
		list($pdfHeight,$pdfWidth,$imageUrl) = array($group->getHeight()*0.27,
				$group->getWidth()*0.27,
				$imageUrlNe);
	
		$this->imageUrlNe = $imageUrlNe;
	
		$this->imageOutputSize['pdfwidth']  = $group->getWidth()*0.27;
		$this->imageOutputSize['pdfheight']	= $group->getHeight()*0.27;
	
		return array('pdfwidth'		 =>	$group->getWidth()*0.27,
				'pdfheight'	 =>	$group->getHeight()*0.27,
				'imageCreated'	 =>	$this->imageCreate,
				'barcodestring' => 'barcode'.$this->imageRandom,
				'imageUrlNe'    => $imageUrlNe
		);
	
	}
	
	private function pixelStretchWrap($imageSource,$width,$height)
	{
		$im = imagecreatefromjpeg($imageSource);
	
		$size = array();
		$size['width'] = $width;
		$size['height'] = $height;
			
		$imss = array();
	
		$imss['top'] = $this->pixelstretchcreateWrap($im, $size, 'TOP');
	
		$imss['bottom'] = $this->pixelstretchcreateWrap($im, $size, 'BOTTOM');
	
		$imss['left'] = $this->pixelstretchcreateWrap($im, $size, 'LEFT');
	
		$imss['right'] = $this->pixelstretchcreateWrap($im, $size, 'RIGHT');
	
		return $imss;
	}
	
	/* Function: Pixel Stretch Create
	 * @params : $imsource -path the image on which task is perform
	* 			 $size array which contain height and width
	* 			 $side side for image for which pixel stretch perform
	* @return : return gd image resource vairable
	*
	*/
	
	public function pixelstretchcreateWrap($imsource,$size,$side)
	{
			
	
		switch ($side) {
			case 'TOP':
	
				$imss = imagecreate($size['width'], 46);
	
				$start_y = 0;
	
				$imageInde = array();
	
				for($start_x = 0 ; $start_x < $size['width']; $start_x++ )
				{
	
					$color_index = imagecolorat($imsource, $start_x ,$start_y);
	
					$imageInde[$start_x] =  imagecolorsforindex($imsource, $color_index);
	
					$mycolorline = imagecolorallocate ( $imss ,$imageInde[$start_x]['red'] , $imageInde[$start_x]['green'] , $imageInde[$start_x]['blue'] );
	
					imageline ( $imss , $start_x , 0  , $start_x , 144  , $color_index );
				}
	
				return $imss;
	
				break;
					
			case 'BOTTOM':
	
				$imss = imagecreate($size['width'], 40);
	
				$start_y = $size['height']-1;
	
				$imageInde = array();
	
				for($start_x = 0 ; $start_x < $size['width']; $start_x++ )
				{
	
					$color_index = imagecolorat($imsource, $start_x ,$start_y);
	
					$imageInde[$start_x] =  imagecolorsforindex($imsource, $color_index);
	
					$mycolorline = imagecolorallocate ( $imss ,$imageInde[$start_x]['red'] , $imageInde[$start_x]['green'] , $imageInde[$start_x]['blue'] );
	
					imageline ( $imss , $start_x , 0  , $start_x , 144  , $color_index );
				}
	
				return $imss;
	
				break;
					
			case 'LEFT':
	
				$imss = imagecreate(40, $size['height']);
	
				$start_x = 0;
	
				$imageInde = array();
	
				for($start_y = 0 ; $start_y <$size['height']; $start_y++ )
				{
	
					$color_index = imagecolorat($imsource, $start_x ,$start_y);
	
					$imageInde[$start_y] =  imagecolorsforindex($imsource, $color_index);
	
					$mycolorline = imagecolorallocate ( $imss ,$imageInde[$start_y]['red'] , $imageInde[$start_y]['green'] , $imageInde[$start_y]['blue'] );
	
					imageline ( $imss , 0 , $start_y  , 144 , $start_y  , $color_index );
				}
	
				return $imss;
	
				break;
	
			case 'RIGHT':
	
				$imss = imagecreate(40, $size['height']);
	
				$start_x = $size['width'] - 1;
	
				$imageInde = array();
	
				for($start_y = 0 ; $start_y < $size['height']; $start_y++ )
				{
	
					$color_index = imagecolorat($imsource, $start_x ,$start_y);
	
					$imageInde[$start_y] =  imagecolorsforindex($imsource, $color_index);
	
					$mycolorline = imagecolorallocate ( $imss ,$imageInde[$start_y]['red'] , $imageInde[$start_y]['green'] , $imageInde[$start_y]['blue'] );
	
					imageline ( $imss , 0 , $start_y  , 144 , $start_y  , $color_index );
				}
	
				return $imss;
				break;
					
					
		}
	
	
	}
	
	private function addCornerWrap($cornerColor, ImageWorkshopLayer $imageCorner)
	{
		$groupTransparentTop = ImageWorkshop::initVirginLayer(40,46,$cornerColor);
		
		$groupTransparentB = ImageWorkshop::initVirginLayer(40,40,$cornerColor);
	
		$imageCorner->addLayerOnTop($groupTransparentTop, 0, 0, 'LT');
		$imageCorner->addLayerOnTop($groupTransparentB, 0, 0, 'LB');
		$imageCorner->addLayerOnTop($groupTransparentTop, 0, 0, 'RT');
		$imageCorner->addLayerOnTop($groupTransparentB, 0, 0, 'RB');
	}
	
	function createLayoutWrap($layout = 1)
	{
	
		if($this->imagePost['effect_id']){
	
			$urlEffect = 'effectIMp'.$this->imageRandom.'.jpg';
			$layoutEffect = ImageWorkshop::initFromPath($this->imageImagePath['base'].'cropped/'.$this->imagePost['wrapView']);
			$layoutEffect->save($this->imageImagePath['save'],$urlEffect ,true,null,100);
				
			$layoutEffect->save($this->imageImagePath['save'],'effect'.$urlEffect ,true,null,100);
				
			$pathurlNewMy = $this->imageImagePath['save'].'/'.$urlEffect;
			$pathurlNewMyE = $this->imageImagePath['save'].'/effect'.$urlEffect;
				
			//$pathurlNewMyE = '/var/betawebsites/pixelpaint/pixelpaint/siteupload/bc/effect'.$urlEffect;
				
			$pathurlNewMyES = $this->imageImagePath['save'].'/effectSave'.$urlEffect;
				
			if($this->addEffectToImage($pathurlNewMy, $pathurlNewMyE,$pathurlNewMyE)){
				$layoutLayer = ImageWorkshop::initFromPath($pathurlNewMyE);
			}else{
				throw new ImageWorkshopExceptionExtension("Effect not done");
			}
				
		}else{
				
			$layoutLayer = ImageWorkshop::initFromPath($this->imageImagePath['base'].'cropped/'.$this->imagePost['wrapView']);
	
		}
	
		//$widthRatio = 500; 
		//$heightRatio = $widthRatio * ( $this->imageSize['height'] / $this->imageSize['width'] ) ;
		
		extract($this->positionFormat()) ;
		
		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
		
		array($widthRatio,$heightRatio,false,0,0,'MM');
		
		$urlNew = 'View'.$this->imageRandom.'.jpg';
		
		$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
		
		
		switch ($layout) {
	
			case 1:
	
	
				$urlNew = 'layoutone'.$this->imageRandom.'.png';
	
				$this->imageCreate['layoutone'] = "/siteupload/bc/$urlNew";
	
				$urlNewWrap = 'Wrap'.$urlNew;
	
				$dataImages[] = $this->finaloutputWrapView($layoutLayer,$urlNewWrap);
	
				return $dataImages;
				
				break;
	
			case 2:
	
				$layoutLayerLeft = clone $layoutLayer;
				$layoutLayerRight = clone $layoutLayer;
	
				
				$layoutLayerLeft->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight(),0,0,'LT');
				$layoutLayerRight->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight(),0,0,'RT');

				
				
				$layoutLayerLeft->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRight->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$urlNewLeft = 'layoutleft'.$this->imageRandom.'.png';
				$urlNewRight = 'layoutright'.$this->imageRandom.'.png';
	
				$urlNewWrapLeft = 'WrapLeft'.$urlNewLeft;
	
				$dataImages[] = $this->finaloutputWrapView($layoutLayerLeft,$urlNewWrapLeft);
	
				$urlNewWrapRight = 'WrapRight'.$urlNewRight;
	
				$dataImages[] = $this->finaloutputWrapView($layoutLayerRight,$urlNewWrapRight);
	
				return $dataImages;
	
				break;
	
			case 3:
	
				$layoutLayerLeft = clone $layoutLayer;
				$layoutLayerMiddle = clone $layoutLayer;
				$layoutLayerRight = clone $layoutLayer;
	
				$middlecut = $layoutLayer->getWidth()/3 ;
	
				$layoutLayerLeft->cropInPixel($middlecut,$layoutLayer->getHeight(),0,0,'LT');
				$layoutLayerMiddle->cropInPixel($middlecut,$layoutLayer->getHeight(),$middlecut,0,'LT');
				$layoutLayerRight->cropInPixel($middlecut,$layoutLayer->getHeight(),$middlecut*2,0,'LT');

				$layoutLayerLeft->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerMiddle->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRight->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$urlNewLeft   = 'layoutleft'.$this->imageRandom.'.png';
				$urlNewMiddle = 'layoutmiddle'.$this->imageRandom.'.png';
				$urlNewRight  = 'layoutright'.$this->imageRandom.'.png';
	
				$urlNewWrapLeft = 'WrapLeft'.$urlNewLeft;
	
				$dataImages[] = $this->finaloutputWrapView($layoutLayerLeft,$urlNewWrapLeft);
	
				$urlNewWrapMiddle = 'WrapRight'.$urlNewMiddle;
	
				$dataImages[] = $this->finaloutputWrapView($layoutLayerMiddle,$urlNewWrapMiddle);
	
				$urlNewWrapRight = 'WrapRight'.$urlNewRight;
	
				$dataImages[] = $this->finaloutputWrapView($layoutLayerRight,$urlNewWrapRight);
	
				return $dataImages;
				
				break;
	
			case 4:
	
				$layoutLayerLeftTop 	= clone $layoutLayer;
				$layoutLayerLeftBottom 	= clone $layoutLayer;
				$layoutLayerRightTop 	= clone $layoutLayer;
				$layoutLayerRightBottom = clone $layoutLayer;
	
				$urlNewLeftTop   = 'layoutLeftTop'.$this->imageRandom.'.png';
				$urlNewLeftBottom = 'layoutLeftBottom'.$this->imageRandom.'.png';
				$urlNewRightTop  = 'layoutRightTop'.$this->imageRandom.'.png';
				$urlNewRightBottom  = 'layoutRightBottom'.$this->imageRandom.'.png';
	
				$urlNewWrapLeftTop 		= 'WrapLeftTop'.$urlNewLeftTop;
				$urlNewWrapLeftBottom 	= 'WrapLeftBottom'.$urlNewLeftBottom;
				$urlNewWrapRightTop 	= 'WrapRightTop'.$urlNewRightTop;
				$urlNewWrapRightBottom 	= 'WrapRightBottom'.$urlNewRightBottom;
	
				/* LEFT TOP */
	
				$layoutLayerLeftTop->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'LT');

				$layoutLayerLeftTop->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$dataImages[] = $this->finaloutputWrapView($layoutLayerLeftTop,$urlNewWrapLeftTop);
	
				/* RIGHT TOP */
	
				$layoutLayerRightTop->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'RT');

				$layoutLayerRightTop->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$dataImages[] = $this->finaloutputWrapView($layoutLayerRightTop,$urlNewWrapRightTop);
	
				/* LEFT BOTTOM */
	
				$layoutLayerLeftBottom->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'LB');
	
				$layoutLayerLeftBottom->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
				
				$dataImages[] = $this->finaloutputWrapView($layoutLayerLeftBottom,$urlNewWrapLeftBottom);
	
				/* RIGHT BOTTOM */
	
				$layoutLayerRightBottom->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'RB');
				
				$layoutLayerRightBottom->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
	
				$dataImages[] = $this->finaloutputWrapView($layoutLayerRightBottom,$urlNewWrapRightBottom);
	
				/* FINAL PDF */
	
				return $dataImages; 
					
				break;
	
	
		}
	}
	
	
	private function positionFormat()
	{
		
		if($this->imagePost['format_id'] == 1){
			$widthRatio = 500;
			$heightRatio = $widthRatio * ( $this->imageSize['height'] / $this->imageSize['width'] ) ;
		}elseif(($this->imagePost['format_id'] == 2)){
			$widthRatio = 500;
			$heightRatio = $widthRatio * ( $this->imageSize['width'] / $this->imageSize['height'] ) ;
		}else{
			$widthRatio = 500;
			$heightRatio = $widthRatio * ( $this->imageSize['height'] / $this->imageSize['width'] ) ;
		}
		
		return array('widthRatio'=>$widthRatio,'heightRatio'=>$heightRatio);
	}  
	
	
	private function positionFormatPdf()
	{
	
		if($this->imagePost['format_id'] == 1){
			$widthRatio = $this->imageSize['width'];
			$heightRatio = $this->imageSize['height'];
		}elseif(($this->imagePost['format_id'] == 2)){
			$widthRatio = $this->imageSize['height'];
			$heightRatio =  $this->imageSize['width'];
		}else{
			$widthRatio = $this->imageSize['width'];
			$heightRatio = $this->imageSize['height'];
		}
	
		return array('widthRatio'=>$widthRatio,'heightRatio'=>$heightRatio);
	}
	

	function createLayoutWrapGallery($layout = 1)
	{
	
		if($this->imagePost['effect_id']){
	
			$urlEffect = 'effectIMp'.$this->imageRandom.'.jpg';
			$layoutEffect = ImageWorkshop::initFromPath($this->imageImagePath['base'].'cropped/'.$this->imagePost['wrapView']);
			$layoutEffect->save($this->imageImagePath['save'],$urlEffect ,true,null,100);
	
			$layoutEffect->save($this->imageImagePath['save'],'effect'.$urlEffect ,true,null,100);
	
			$pathurlNewMy = $this->imageImagePath['save'].'/'.$urlEffect;
			$pathurlNewMyE = $this->imageImagePath['save'].'/effect'.$urlEffect;
	
			//$pathurlNewMyE = '/var/betawebsites/pixelpaint/pixelpaint/siteupload/bc/effect'.$urlEffect;
	
			$pathurlNewMyES = $this->imageImagePath['save'].'/effectSave'.$urlEffect;
	
			if($this->addEffectToImage($pathurlNewMy, $pathurlNewMyE,$pathurlNewMyE)){
				$layoutLayer = ImageWorkshop::initFromPath($pathurlNewMyE);
			}else{
				throw new ImageWorkshopExceptionExtension("Effect not done");
			}
	
		}else{
	
			$layoutLayer = ImageWorkshop::initFromPath($this->imageImagePath['base'].'cropped/'.$this->imagePost['wrapView']);
	
		}
	
		//$widthRatio = 500;
		//$heightRatio = $widthRatio * ( $this->imageSize['height'] / $this->imageSize['width'] ) ;
	
		extract($this->positionFormat()) ;
	
		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
	
		array($widthRatio,$heightRatio,false,0,0,'MM');
	
		$urlNew = 'View'.$this->imageRandom.'.jpg';
	
		$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
	
	
		switch ($layout) {
	
			case 1:
	
	
				$urlNew = 'layoutone'.$this->imageRandom.'.png';
	
				$this->imageCreate['layoutone'] = "/siteupload/bc/$urlNew";
	
				$urlNewWrap = 'Wrap'.$urlNew;
				
				$layoutLayer->resizeInPixel($layoutLayer->getWidth()+80, $layoutLayer->getHeight()+86, $conserveProportion, $positionX, $positionY, $position);
				
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayer,$urlNewWrap);
	
				return $dataImages;
	
				break;
	
			case 2:
	
				$layoutLayerLeft = clone $layoutLayer;
				$layoutLayerRight = clone $layoutLayer;
	
	
				$layoutLayerLeft->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight(),0,0,'LT');
				$layoutLayerRight->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight(),0,0,'RT');
	
	
	
				$layoutLayerLeft->resizeInPixel($thumbWidth+40, $thumbHeight+80, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRight->resizeInPixel($thumbWidth+40, $thumbHeight+80, $conserveProportion, $positionX, $positionY, $position);
	
				$urlNewLeft = 'layoutleft'.$this->imageRandom.'.png';
				$urlNewRight = 'layoutright'.$this->imageRandom.'.png';
	
				$urlNewWrapLeft = 'WrapLeft'.$urlNewLeft;
	
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayerLeft,$urlNewWrapLeft,$layoutLayerRight);
	
				$urlNewWrapRight = 'WrapRight'.$urlNewRight;
	
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayerRight,$urlNewWrapRight,$layoutLayerLeft);
	
				return $dataImages;
	
				break;
	
			case 3:
	
				$layoutLayerLeft = clone $layoutLayer;
				$layoutLayerMiddle = clone $layoutLayer;
				$layoutLayerRight = clone $layoutLayer;
	
				$middlecut = $layoutLayer->getWidth()/3 ;
	
				$layoutLayerLeft->cropInPixel($middlecut,$layoutLayer->getHeight(),0,0,'LT');
				$layoutLayerMiddle->cropInPixel($middlecut,$layoutLayer->getHeight(),$middlecut,0,'LT');
				$layoutLayerRight->cropInPixel($middlecut,$layoutLayer->getHeight(),$middlecut*2,0,'LT');
	
				$layoutLayerLeft->resizeInPixel($thumbWidth+40, $thumbHeight+80, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerMiddle->resizeInPixel($thumbWidth, $thumbHeight+80, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRight->resizeInPixel($thumbWidth+40, $thumbHeight+80, $conserveProportion, $positionX, $positionY, $position);
	
				$urlNewLeft   = 'layoutleft'.$this->imageRandom.'.png';
				$urlNewMiddle = 'layoutmiddle'.$this->imageRandom.'.png';
				$urlNewRight  = 'layoutright'.$this->imageRandom.'.png';
	
				$urlNewWrapLeft = 'WrapLeft'.$urlNewLeft;
	
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayerLeft,$urlNewWrapLeft,$layoutLayerMiddle);
	
				$urlNewWrapMiddle = 'WrapRight'.$urlNewMiddle;
	
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayerMiddle,$urlNewWrapMiddle,$layoutLayerLeft,$layoutLayerRight);
	
				$urlNewWrapRight = 'WrapRight'.$urlNewRight;
	
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayerRight,$urlNewWrapRight,$layoutLayerMiddle);
	
				return $dataImages;
	
				break;
	
			case 4:
	
				$layoutLayerLeftTop 	= clone $layoutLayer;
				$layoutLayerLeftBottom 	= clone $layoutLayer;
				$layoutLayerRightTop 	= clone $layoutLayer;
				$layoutLayerRightBottom = clone $layoutLayer;
	
				$urlNewLeftTop   = 'layoutLeftTop'.$this->imageRandom.'.png';
				$urlNewLeftBottom = 'layoutLeftBottom'.$this->imageRandom.'.png';
				$urlNewRightTop  = 'layoutRightTop'.$this->imageRandom.'.png';
				$urlNewRightBottom  = 'layoutRightBottom'.$this->imageRandom.'.png';
	
				$urlNewWrapLeftTop 		= 'WrapLeftTop'.$urlNewLeftTop;
				$urlNewWrapLeftBottom 	= 'WrapLeftBottom'.$urlNewLeftBottom;
				$urlNewWrapRightTop 	= 'WrapRightTop'.$urlNewRightTop;
				$urlNewWrapRightBottom 	= 'WrapRightBottom'.$urlNewRightBottom;
	
				/* LEFT TOP */
	
				$layoutLayerLeftTop->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'LT');
				
				$layoutLayerRightTop->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'RT');
				
				$layoutLayerLeftBottom->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'LB');
				
				$layoutLayerRightBottom->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'RB');
	
				$layoutLayerLeftTop->resizeInPixel($thumbWidth+40, $thumbHeight+46, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRightTop->resizeInPixel($thumbWidth+40, $thumbHeight+46, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerLeftBottom->resizeInPixel($thumbWidth+40, $thumbHeight+40, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRightBottom->resizeInPixel($thumbWidth+40, $thumbHeight+40, $conserveProportion, $positionX, $positionY, $position);
				
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayerLeftTop,$urlNewWrapLeftTop,$layoutLayerRightTop,$layoutLayerLeftBottom);
	
				/* RIGHT TOP */
	
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayerRightTop,$urlNewWrapRightTop,$layoutLayerLeftTop,$layoutLayerRightBottom);
	
				/* LEFT BOTTOM */
	
	
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayerLeftBottom,$urlNewWrapLeftBottom,$layoutLayerLeftTop,$layoutLayerRightBottom);
	
				/* RIGHT BOTTOM */
	
				$dataImages[] = $this->finaloutputWrapViewGallery($layoutLayerRightBottom,$urlNewWrapRightBottom,$layoutLayerRightTop,$layoutLayerLeftBottom);
	
				/* FINAL PDF */
	
				return $dataImages;
					
				break;
	
	
		}
	}
	
	private function getPointWrapType()
	{
		
		if($this->imagePost['layout'] == 4){
			
			if($this->counter == 1)
			{
				$x = 0;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 2)
			{
				$x = 40;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 3)
			{
				$x = 0;
				$y = 46;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 4)
			{
				$x = 40;
				$y = 46;
				//$c = 1;
				//$this->counter = $c;
			}
			
		}else{
		
		
			if($this->counter == 1)
			{
				$x = 0;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 2)
			{
				$x = 40;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 3)
			{
				$x = 40;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;			
			}elseif($this->counter == 4)
			{
				$x = 40;
				$y = 46;
				//$c = 1;
				//$this->counter = $c;			
			}
		
		}
		
		return array('x'=>$x,'y'=>$y);
	}
	
	public function finaloutputWrapViewGallery($imageUrlPerform,$nameImg,$imageUrlPerformSideone = null,$imageUrlPerformSidetwo = null)
	{
	
	
		$siteUrlMain = $this->imageImagePath['baseUrl'];
	
		$pinguLayer = clone $imageUrlPerform;
	
		$pinguLayer->save($this->imageImagePath['save'],'ViewWrap'.$this->imageRandom.'.jpg' , true, null, 95);
	
		$amritSavePixel = $this->imageImagePath['save'].'/ViewWrap'.$this->imageRandom.'.jpg' ;
	
	
		switch ($this->imagePost['wrap_type']) {
	
			default:
				list($backgroundColor, $backgroundCornerColor ) = array('11dd66','FFFFFF') ;
				break;
		}
	
		if($this->imagePost['wrap_type'] == 1){
	
			$backgroundColor = '000000';
	
		}else{
	
			$backgroundColor = 'FFFFFF';
		}
		
	
		switch ($this->imagePost['layout']) 
		{
			case 1:
				$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth(),$pinguLayer->getHeight(),$backgroundColor);
			break;
			
			case 2:
				$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+40,$pinguLayer->getHeight(),$backgroundColor);
			break;
			
			case 3:
				if($this->counter==2){
					$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+80,$pinguLayer->getHeight(),$backgroundColor);
				}else{
					$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+40,$pinguLayer->getHeight(),$backgroundColor);
				}

			break;
				
			case 4:
				if($this->counter==1 || $this->counter==2 ){
					$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+40,$pinguLayer->getHeight()+40,$backgroundColor);
				}elseif($this->counter==3 || $this->counter == 4){
					$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+40,$pinguLayer->getHeight()+46,$backgroundColor);
				}
			break;
		}
		

		
		$pinguLayerTop 		= clone $pinguLayer;
		$pinguLayerRight 	= clone $pinguLayer;
		$pinguLayerBottom 	= clone $pinguLayer;
		$pinguLayerLeft		= clone $pinguLayer;
	
		$pinguLayerTop->cropInPixel($pinguLayer->getWidth(),46,0,0,'LT');
		$pinguLayerRight->cropInPixel(40,$pinguLayer->getHeight(),0,0,'RT');
		$pinguLayerBottom->cropInPixel($pinguLayer->getWidth(),40,0,0,'RB');
		$pinguLayerLeft->cropInPixel(40,$pinguLayer->getHeight(),0,0,'LB');
		
		if($imageUrlPerformSideone != null )
		{
			$stripLayerOne 			= clone $imageUrlPerformSideone;
			$stripLayerOneTop 		= clone $stripLayerOne;
			$stripLayerOneRight 	= clone $stripLayerOne;
			$stripLayerOneBottom 	= clone $stripLayerOne;
			$stripLayerOneLeft		= clone $stripLayerOne;
			
			$stripLayerOneTop->cropInPixel($stripLayerOne->getWidth(),40,0,0,'LT');
			$stripLayerOneRight->cropInPixel(40,$stripLayerOne->getHeight(),0,0,'RT');
			$stripLayerOneBottom->cropInPixel($stripLayerOne->getWidth(),46,0,0,'RB');
			$stripLayerOneLeft->cropInPixel(40,$stripLayerOne->getHeight(),0,0,'LB');
		}
		
		if($imageUrlPerformSidetwo != null )
		{
			$stripLayerTwo 			= clone $imageUrlPerformSidetwo;
			$stripLayerTwoTop 		= clone $stripLayerTwo;
			$stripLayerTwoRight 	= clone $stripLayerTwo;
			$stripLayerTwoBottom 	= clone $stripLayerTwo;
			$stripLayerTwoLeft		= clone $stripLayerTwo;
			
			$stripLayerTwoTop->cropInPixel($stripLayerTwo->getWidth(),40,0,0,'LT');
			$stripLayerTwoRight->cropInPixel(40,$stripLayerTwo->getHeight(),0,0,'RT');
			$stripLayerTwoBottom->cropInPixel($stripLayerTwo->getWidth(),40,0,0,'RB');
			$stripLayerTwoLeft->cropInPixel(40,$stripLayerTwo->getHeight(),0,0,'LB');
		}
	
		switch ($this->imagePost['wrap_type']) {
	
	
			case 4:
	
	
				if($this->imagePost['layout']==1)
				{
					list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
						

					$pointXY = $this->getPointWrapType();
					
					$group->addLayerOnTop($pinguLayer, $pointXY['x'], $pointXY['y'], 'LT');
						
	
				}elseif ($this->imagePost['layout']==2)
				{
					list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
	
					$pointXY = $this->getPointWrapType();
						
					$group->addLayerOnTop($pinguLayer, $pointXY['x'], $pointXY['y'], 'LT');
						
						
				}elseif($this->imagePost['layout']==3)
				{
					list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
						
	
					$pointXY = $this->getPointWrapType();
	
					$group->addLayerOnTop($pinguLayer, $pointXY['x'], $pointXY['y'], 'LT');
	
						
				}elseif($this->imagePost['layout']==4)
				{
					list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
	
						
					$pointXY = $this->getPointWrapType();
						
					$group->addLayerOnTop($pinguLayer, $pointXY['x'], $pointXY['y'], 'LT');
						
						
				}
	
	
	
				break;
	
			default:
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
				break;
	
	
		}
	

		if(($this->counter == 1) && ($this->imagePost['layout'] == 2) )
		{
			$group->addLayerOnTop($stripLayerOneLeft,0,0,'RT');
		
		}elseif(($this->counter == 2) && ($this->imagePost['layout'] == 2) ){
				
			$group->addLayerOnTop($stripLayerOneRight,0,0,'LT');
		
		}elseif(($this->counter == 1) && ($this->imagePost['layout'] == 3))
		{
			$group->addLayerOnTop($stripLayerOneLeft,0,0,'RT');
			
		}elseif(($this->counter == 2) && ($this->imagePost['layout'] == 3))
		{
			$group->addLayerOnTop($stripLayerOneRight,0,0,'LT');
			$group->addLayerOnTop($stripLayerTwoLeft,0,0,'RT');
		}elseif(($this->counter == 3) && ($this->imagePost['layout'] == 3))
		{
			$group->addLayerOnTop($stripLayerOneRight,0,0,'LT');
		}elseif(($this->counter == 1) && ($this->imagePost['layout'] == 4))
		{
			$group->addLayerOnTop($stripLayerOneLeft,0,0,'RT');
			$group->addLayerOnTop($stripLayerTwoTop,0,0,'LB');
			
		}elseif(($this->counter == 2) && ($this->imagePost['layout'] == 4))
		{
			$group->addLayerOnTop($stripLayerOneRight,0,0,'LT');
			$group->addLayerOnTop($stripLayerTwoTop,0,0,'RB');
		}elseif(($this->counter == 3) && ($this->imagePost['layout'] == 4))
		{
			$group->addLayerOnTop($stripLayerTwoLeft,0,46,'RT');
			$group->addLayerOnTop($stripLayerOneBottom,0,0,'LT');
		}elseif(($this->counter == 4) && ($this->imagePost['layout'] == 4))
		{
			$group->addLayerOnTop($stripLayerTwoRight,0,46,'LT');
			$group->addLayerOnTop($stripLayerOneBottom,0,0,'RT');
		}
		
		$c = $this->counter;
		$this->counter = $c + 1;
		$this->addCornerWrap($backgroundCornerColor, $group);
		
		
		$imageUrlNe = '';
	
		$group->save($this->imageImagePath['save'],'/tmp/'.$nameImg , true, null, 100);
		$imageUrlNe .=    "<img src='$siteUrlMain/siteupload/bc/tmp/$nameImg' ></img>";
	
	
		list($pdfHeight,$pdfWidth,$imageUrl) = array($group->getHeight()*0.27,
				$group->getWidth()*0.27,
				$imageUrlNe);
	
		$this->imageUrlNe = $imageUrlNe;
	
		$this->imageOutputSize['pdfwidth']  = $group->getWidth()*0.27;
		$this->imageOutputSize['pdfheight']	= $group->getHeight()*0.27;
	
		return array('pdfwidth'		 =>	$group->getWidth()*0.27,
				'pdfheight'	 =>	$group->getHeight()*0.27,
				'imageCreated'	 =>	$this->imageCreate,
				'barcodestring' => 'barcode'.$this->imageRandom,
				'imageUrlNe'    => $imageUrlNe
		);
	
	}

	function createLayoutWrapGalleryPdf($layout = 4)
	{
	
		if($this->imagePost['effect_id']){
	
			$urlEffect = 'effectIMp'.$this->imageRandom.'.jpg';
			$layoutEffect = ImageWorkshop::initFromPath($this->imageImagePath['base'].'cropped/'.$this->imagePost['image']);
			$layoutEffect->save($this->imageImagePath['save'],$urlEffect ,true,null,100);
	
			$layoutEffect->save($this->imageImagePath['save'],'effect'.$urlEffect ,true,null,100);
	
			$pathurlNewMy = $this->imageImagePath['save'].'/'.$urlEffect;
			$pathurlNewMyE = $this->imageImagePath['save'].'/effect'.$urlEffect;
	
			//$pathurlNewMyE = '/var/betawebsites/pixelpaint/pixelpaint/siteupload/bc/effect'.$urlEffect;
	
			$pathurlNewMyES = $this->imageImagePath['save'].'/effectSave'.$urlEffect;
	
			if($this->addEffectToImage($pathurlNewMy, $pathurlNewMyE,$pathurlNewMyE)){
				$layoutLayer = ImageWorkshop::initFromPath($pathurlNewMyE);
			}else{
				throw new ImageWorkshopExceptionExtension("Effect not done");
			}
	
		}else{
	
			$layoutLayer = ImageWorkshop::initFromPath($this->imageImagePath['base'].'cropped/'.$this->imagePost['image']);
	
		}
	
		//$widthRatio = 500;
		//$heightRatio = $widthRatio * ( $this->imageSize['height'] / $this->imageSize['width'] ) ;
	
		extract($this->positionFormatPdf()) ;
	
		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
	
		//array($widthRatio,$heightRatio,false,0,0,'MM');
		
		array($widthRatio*96,$heightRatio*96,false,0,0,'MM');
	
		$urlNew = 'View'.$this->imageRandom.'.jpg';
	
		$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
	
	
		switch ($layout) {
	
			case 1:
	
	
				$urlNew = 'layoutone'.$this->imageRandom.'.png';
	
				$this->imageCreate['layoutone'] = "/siteupload/bc/$urlNew";
	
				$urlNewWrap = 'Wrap'.$urlNew;
	
				$layoutLayer->resizeInPixel($layoutLayer->getWidth()+288, $layoutLayer->getHeight()+288, $conserveProportion, $positionX, $positionY, $position);
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayer,$urlNewWrap);
	
				$this->printpdfNew($dataImages[0]['pdfwidth'], $dataImages[0]['pdfheight'], 'SingleLayout', $dataImages[0]['imageUrlNe']);
				
				
				return $dataImages;
	
				break;
	
			case 2:
	
				$layoutLayerLeft = clone $layoutLayer;
				$layoutLayerRight = clone $layoutLayer;
	
	
				$layoutLayerLeft->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight(),0,0,'LT');
				$layoutLayerRight->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight(),0,0,'RT');
	
	
	
				$layoutLayerLeft->resizeInPixel($thumbWidth+144, $thumbHeight+288, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRight->resizeInPixel($thumbWidth+144, $thumbHeight+288, $conserveProportion, $positionX, $positionY, $position);
	
				$urlNewLeft = 'layoutleft'.$this->imageRandom.'.png';
				$urlNewRight = 'layoutright'.$this->imageRandom.'.png';
	
				$urlNewWrapLeft = 'WrapLeft'.$urlNewLeft;
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayerLeft,$urlNewWrapLeft,$layoutLayerRight);
	
				$urlNewWrapRight = 'WrapRight'.$urlNewRight;
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayerRight,$urlNewWrapRight,$layoutLayerLeft);
	
				$this->printpdfNew($dataImages[0]['pdfwidth'], $dataImages[0]['pdfheight'], 'SecondLayout', $dataImages[0]['imageUrlNe'].$dataImages[1]['imageUrlNe']);
								
				//return $dataImages;
	
				break;
	
			case 3:
	
				$layoutLayerLeft = clone $layoutLayer;
				$layoutLayerMiddle = clone $layoutLayer;
				$layoutLayerRight = clone $layoutLayer;
	
				$middlecut = $layoutLayer->getWidth()/3 ;
	
				$layoutLayerLeft->cropInPixel($middlecut,$layoutLayer->getHeight(),0,0,'LT');
				$layoutLayerMiddle->cropInPixel($middlecut,$layoutLayer->getHeight(),$middlecut,0,'LT');
				$layoutLayerRight->cropInPixel($middlecut,$layoutLayer->getHeight(),$middlecut*2,0,'LT');
	
				$layoutLayerLeft->resizeInPixel($thumbWidth+144, $thumbHeight+288, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerMiddle->resizeInPixel($thumbWidth, $thumbHeight+288, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRight->resizeInPixel($thumbWidth+144, $thumbHeight+288, $conserveProportion, $positionX, $positionY, $position);
	
				$urlNewLeft   = 'layoutleft'.$this->imageRandom.'.png';
				$urlNewMiddle = 'layoutmiddle'.$this->imageRandom.'.png';
				$urlNewRight  = 'layoutright'.$this->imageRandom.'.png';
	
				$urlNewWrapLeft = 'WrapLeft'.$urlNewLeft;
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayerLeft,$urlNewWrapLeft,$layoutLayerMiddle);
	
				$urlNewWrapMiddle = 'WrapRight'.$urlNewMiddle;
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayerMiddle,$urlNewWrapMiddle,$layoutLayerLeft,$layoutLayerRight);
	
				$urlNewWrapRight = 'WrapRight'.$urlNewRight;
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayerRight,$urlNewWrapRight,$layoutLayerMiddle);
	
				$this->printpdfNew($dataImages[0]['pdfwidth'],
						$dataImages[0]['pdfheight'],
						'ThirdLayout',
						$dataImages[0]['imageUrlNe'].$dataImages[1]['imageUrlNe'].$dataImages[2]['imageUrlNe']);
				
				//return $dataImages;
	
				break;
	
			case 4:
	
				$layoutLayerLeftTop 	= clone $layoutLayer;
				$layoutLayerLeftBottom 	= clone $layoutLayer;
				$layoutLayerRightTop 	= clone $layoutLayer;
				$layoutLayerRightBottom = clone $layoutLayer;
	
				$urlNewLeftTop   = 'layoutLeftTop'.$this->imageRandom.'.png';
				$urlNewLeftBottom = 'layoutLeftBottom'.$this->imageRandom.'.png';
				$urlNewRightTop  = 'layoutRightTop'.$this->imageRandom.'.png';
				$urlNewRightBottom  = 'layoutRightBottom'.$this->imageRandom.'.png';
	
				$urlNewWrapLeftTop 		= 'WrapLeftTop'.$urlNewLeftTop;
				$urlNewWrapLeftBottom 	= 'WrapLeftBottom'.$urlNewLeftBottom;
				$urlNewWrapRightTop 	= 'WrapRightTop'.$urlNewRightTop;
				$urlNewWrapRightBottom 	= 'WrapRightBottom'.$urlNewRightBottom;
	
				/* LEFT TOP */
	
				$layoutLayerLeftTop->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'LT');
	
				$layoutLayerRightTop->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'RT');
	
				$layoutLayerLeftBottom->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'LB');
	
				$layoutLayerRightBottom->cropInPixel($layoutLayer->getWidth()/2,$layoutLayer->getHeight()/2,0,0,'RB');
	
				$layoutLayerLeftTop->resizeInPixel($thumbWidth+144, $thumbHeight+144, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRightTop->resizeInPixel($thumbWidth+144, $thumbHeight+144, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerLeftBottom->resizeInPixel($thumbWidth+144, $thumbHeight+144, $conserveProportion, $positionX, $positionY, $position);
				$layoutLayerRightBottom->resizeInPixel($thumbWidth+144, $thumbHeight+144, $conserveProportion, $positionX, $positionY, $position);
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayerLeftTop,$urlNewWrapLeftTop,$layoutLayerRightTop,$layoutLayerLeftBottom);
	
				/* RIGHT TOP */
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayerRightTop,$urlNewWrapRightTop,$layoutLayerLeftTop,$layoutLayerRightBottom);
	
				/* LEFT BOTTOM */
	
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayerLeftBottom,$urlNewWrapLeftBottom,$layoutLayerLeftTop,$layoutLayerRightBottom);
	
				/* RIGHT BOTTOM */
	
				$dataImages[] = $this->finaloutputWrapViewGalleryPdf($layoutLayerRightBottom,$urlNewWrapRightBottom,$layoutLayerRightTop,$layoutLayerLeftBottom);
	
				/* FINAL PDF */
	
				$this->printpdfNew($dataImages[0]['pdfwidth'],
						$dataImages[0]['pdfheight'],
						'FourthLayout',
						$dataImages[0]['imageUrlNe'].$dataImages[1]['imageUrlNe'].$dataImages[2]['imageUrlNe'].$dataImages[3]['imageUrlNe']);
				
				//return $dataImages;
					
				break;
	
	
		}
	}
	
	private function getPointWrapTypePdf()
	{
	
		if($this->imagePost['layout'] == 4){
				
			if($this->counter == 1)
			{
				$x = 0;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 2)
			{
				$x = 144;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 3)
			{
				$x = 0;
				$y = 144;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 4)
			{
				$x = 144;
				$y = 144;
				//$c = 1;
				//$this->counter = $c;
			}
				
		}else{
	
	
			if($this->counter == 1)
			{
				$x = 0;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 2)
			{
				$x = 144;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 3)
			{
				$x = 144;
				$y = 0;
				//$c = $this->counter + 1;
				//$this->counter = $c;
			}elseif($this->counter == 4)
			{
				$x = 144;
				$y = 144;
				//$c = 1;
				//$this->counter = $c;
			}
	
		}
	
		return array('x'=>$x,'y'=>$y);
	}
	
	public function finaloutputWrapViewGalleryPdf($imageUrlPerform,$nameImg,$imageUrlPerformSideone = null,$imageUrlPerformSidetwo = null)
	{
	
		$siteUrlMain = $this->imageImagePath['baseUrl'];
		
		$pinguLayer = clone $imageUrlPerform;
		
		
		$pinguLayer->save($this->imageImagePath['save'],'Amrit'.$this->imageRandom.'.png' , true, null, 95);
		
		if($this->imagePost['wrap_type'] == 1){
				
			$backgroundColor = '000000';
				
		}else{
				
			$backgroundColor = 'FFFFFF';
		}
		
		$barcodeData = $this->barcodeGenaration();
		
		$groupBarcode = ImageWorkshop::initFromPath($barcodeData);
		
		
		//$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+288,$pinguLayer->getHeight()+288,$backgroundColor);
		//$groupNew = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+520,$pinguLayer->getHeight()+520,'f1f1f1');
		
		switch ($this->imagePost['layout'])
		{
			case 1:
				$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth(),$pinguLayer->getHeight(),$backgroundColor);
				
				break;
					
			case 2:
				$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+144,$pinguLayer->getHeight(),$backgroundColor);
				break;
					
			case 3:
				if($this->counter==2){
					$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+288,$pinguLayer->getHeight(),$backgroundColor);
				}else{
					$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+144,$pinguLayer->getHeight(),$backgroundColor);
				}
		
				break;
		
			case 4:
				if($this->counter==1 || $this->counter==2 ){
					$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+144,$pinguLayer->getHeight()+144,$backgroundColor);
				}elseif($this->counter==3 || $this->counter == 4){
					$group = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+144,$pinguLayer->getHeight()+144,$backgroundColor);
				}
				
				//$groupNew = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+520,$pinguLayer->getHeight()+520,'f1f1f1');
				break;
		}
		
		
		//$groupNew = ImageWorkshop::initVirginLayer($pinguLayer->getWidth()+520,$pinguLayer->getHeight()+520,'f1f1f1');
		$groupNew = ImageWorkshop::initVirginLayer($group->getWidth()+232,$group->getHeight()+232,'f1f1f1');
		
		$pinguLayerTop 		= clone $pinguLayer;
		$pinguLayerRight 	= clone $pinguLayer;
		$pinguLayerBottom 	= clone $pinguLayer;
		$pinguLayerLeft		= clone $pinguLayer;
		
		$pinguLayerTop->cropInPixel($pinguLayer->getWidth(),144,0,0,'LT');
		$pinguLayerRight->cropInPixel(144,$pinguLayer->getHeight(),0,0,'RT');
		$pinguLayerBottom->cropInPixel($pinguLayer->getWidth(),144,0,0,'RB');
		$pinguLayerLeft->cropInPixel(144,$pinguLayer->getHeight(),0,0,'LB');
		
		if($imageUrlPerformSideone != null )
		{
			$stripLayerOne 			= clone $imageUrlPerformSideone;
			$stripLayerOneTop 		= clone $stripLayerOne;
			$stripLayerOneRight 	= clone $stripLayerOne;
			$stripLayerOneBottom 	= clone $stripLayerOne;
			$stripLayerOneLeft		= clone $stripLayerOne;
		
			$stripLayerOneTop->cropInPixel($stripLayerOne->getWidth(),144,0,0,'LT');
			$stripLayerOneRight->cropInPixel(144,$stripLayerOne->getHeight(),0,0,'RT');
			$stripLayerOneBottom->cropInPixel($stripLayerOne->getWidth(),144,0,0,'RB');
			$stripLayerOneLeft->cropInPixel(144,$stripLayerOne->getHeight(),0,0,'LB');
		}
		
		if($imageUrlPerformSidetwo != null )
		{
			$stripLayerTwo 			= clone $imageUrlPerformSidetwo;
			$stripLayerTwoTop 		= clone $stripLayerTwo;
			$stripLayerTwoRight 	= clone $stripLayerTwo;
			$stripLayerTwoBottom 	= clone $stripLayerTwo;
			$stripLayerTwoLeft		= clone $stripLayerTwo;
		
			$stripLayerTwoTop->cropInPixel($stripLayerTwo->getWidth(),144,0,0,'LT');
			$stripLayerTwoRight->cropInPixel(144,$stripLayerTwo->getHeight(),0,0,'RT');
			$stripLayerTwoBottom->cropInPixel($stripLayerTwo->getWidth(),144,0,0,'RB');
			$stripLayerTwoLeft->cropInPixel(144,$stripLayerTwo->getHeight(),0,0,'LB');
		}
		
		
		switch ($this->imagePost['wrap_type']) {
				
	
			case 4:
		
			
	
				if($this->imagePost['layout']==1)
				{
					list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
	
	
					$pointXY = $this->getPointWrapTypePdf();
						
					$group->addLayerOnTop($pinguLayer, $pointXY['x'], $pointXY['y'], 'LT');
	
	
				}elseif ($this->imagePost['layout']==2)
				{
					list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
	
					$pointXY = $this->getPointWrapTypePdf();
	
					$group->addLayerOnTop($pinguLayer, $pointXY['x'], $pointXY['y'], 'LT');
	
	
				}elseif($this->imagePost['layout']==3)
				{
					list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
	
	
					$pointXY = $this->getPointWrapTypePdf();
	
					$group->addLayerOnTop($pinguLayer, $pointXY['x'], $pointXY['y'], 'LT');
	
	
				}elseif($this->imagePost['layout']==4)
				{
					list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
	
	
					$pointXY = $this->getPointWrapTypePdf();
	
					$group->addLayerOnTop($pinguLayer, $pointXY['x'], $pointXY['y'], 'LT');
	
	
				}
		
			default:
				list($backgroundColor, $backgroundCornerColor ) = array('000000','FFFFFF') ;
				break;
		
		
		}
		
		if(($this->counter == 1) && ($this->imagePost['layout'] == 2) )
		{
			$group->addLayerOnTop($stripLayerOneLeft,0,0,'RT');
		
		}elseif(($this->counter == 2) && ($this->imagePost['layout'] == 2) ){
		
			$group->addLayerOnTop($stripLayerOneRight,0,0,'LT');
		
		}elseif(($this->counter == 1) && ($this->imagePost['layout'] == 3))
		{
			$group->addLayerOnTop($stripLayerOneLeft,0,0,'RT');
		
		}elseif(($this->counter == 2) && ($this->imagePost['layout'] == 3))
		{
			$group->addLayerOnTop($stripLayerOneRight,0,0,'LT');
			$group->addLayerOnTop($stripLayerTwoLeft,0,0,'RT');
		}elseif(($this->counter == 3) && ($this->imagePost['layout'] == 3))
		{
			$group->addLayerOnTop($stripLayerOneRight,0,0,'LT');
		}elseif(($this->counter == 1) && ($this->imagePost['layout'] == 4))
		{
			$group->addLayerOnTop($stripLayerOneLeft,0,0,'RT');
			$group->addLayerOnTop($stripLayerTwoTop,0,0,'LB');
		
		}elseif(($this->counter == 2) && ($this->imagePost['layout'] == 4))
		{
			$group->addLayerOnTop($stripLayerOneRight,0,0,'LT');
			$group->addLayerOnTop($stripLayerTwoTop,0,0,'RB');
		}elseif(($this->counter == 3) && ($this->imagePost['layout'] == 4))
		{
			$group->addLayerOnTop($stripLayerTwoLeft,0,144,'RT');
			$group->addLayerOnTop($stripLayerOneBottom,0,0,'LT');
		}elseif(($this->counter == 4) && ($this->imagePost['layout'] == 4))
		{
			$group->addLayerOnTop($stripLayerTwoRight,0,144,'LT');
			$group->addLayerOnTop($stripLayerOneBottom,0,0,'RT');
		}
		
		$c = $this->counter;
		$this->counter = $c + 1;
				
		$this->addCorner($backgroundCornerColor, $group);
		
		/* Add image canvas to main canvas */
		
		$groupNew->addLayerOnTop($group,110,110,'LT');
		
		/* Add barcode to main canvas */
		
		$groupNew->addLayerOnTop($groupBarcode, 0, 0, 'MT');
		$groupNew->addLayerOnTop($groupBarcode, 0, 10, 'MB');
		
		/* Add register mark to main */
		
		$amreg = $this->addRegistrationMark();
		
		$groupNew->addLayerOnTop($amreg, 55, 0, 'LM');
		$groupNew->addLayerOnTop($amreg, 66, 0, 'RM');
		$groupNew->addLayerOnTop($amreg, 0, 55, 'MT');
		$groupNew->addLayerOnTop($amreg, 0, 66, 'MB');
		
		$imageUrlNe = '';
		
		$groupNew->save($this->imageImagePath['save'],$nameImg , true, null, 100);
		$imageUrlNe .=    "<img src='$siteUrlMain/siteupload/bc/$nameImg' ></img>";
		
		$this->imageCreate['layout_1']['single'] = "/siteupload/bc/$nameImg";
		
		
		list($pdfHeight,$pdfWidth,$imageUrl) = array($groupNew->getHeight()*0.27,
				$groupNew->getWidth()*0.27,
				$imageUrlNe);
		
		$this->imageUrlNe = $imageUrlNe;
		
		$this->imageOutputSize['pdfwidth']  = $groupNew->getWidth()*0.27;
		$this->imageOutputSize['pdfheight']	= $groupNew->getHeight()*0.27;
		
		return array('pdfwidth'		 =>	$groupNew->getWidth()*0.27,
				'pdfheight'	 =>	$groupNew->getHeight()*0.27,
				'imageCreated'	 =>	$this->imageCreate,
				'barcodestring' => 'barcode'.$this->imageRandom,
				'imageUrlNe'    => $imageUrlNe
		);
		
		
	
	}
		
}
