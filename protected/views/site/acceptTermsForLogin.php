
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	    'id'=>'acceptTermsForLoginWindow',
	    // additional javascript options for the dialog plugin
	    'options'=>array(
	        'title'=>Yii::t('site', 'Accept our Terms to continue'),
	        'autoOpen'=>false,
	        'modal'=>true, 
			'resizable'=>false,
			'width'=> '600px',
	    	//'close' => 'js:function(){ showFormErrorsIfExist(); }'
	    ),
	));
?>
	<div class="row" style="padding-top:2em;padding-bottom:1em;">
		<?php 
		echo Yii::t('site', 'We have updated our {terms of use} as of October 28, 2013. By continuing to log in, you agree to our Terms of Use.', array('{terms of use}'=>
				CHtml::ajaxLink(Yii::t('layout', 'Terms of Use'), $this->createUrl('site/terms'),
						array(
								'complete'=> 'function() { $("#termsWindow").dialog("open"); return false;}',
								'update'=> '#termsWindow',
						),
						array(
								'id'=>'showTermsWindowForLoginContinue','tabindex'=>15,'style'=>'color:#6261D8;'))
		));
		?>
	</div>	
	
	</br>	

	<div class="row buttons" style="padding-bottom:1em;">
		<?php
// 		$this->widget('zii.widgets.jui.CJuiButton', array(
// 				'name'=>'ajaxContinueLoginButton',
// 				'caption'=>Yii::t('site', 'I accept, continue'),
// 				'id'=>'continueLoginAjaxButton-'.uniqid(), //Unique ID oluşturmayınca her ajaxta bir önceki sorgular da tekrarlanıyor
// 				'htmlOptions'=>array('type'=>'submit','ajax'=>array(/*'type'=>'POST',*/'url'=>$this->createUrl('site/continueLogin', array('LoginForm'=>$form)), 'complete'=> 'function() { $("#acceptTermsForLoginWindow").dialog("close");}', 'update'=>'#acceptTermsForLoginWindow'
// 				))
// 		));

		$this->widget('zii.widgets.jui.CJuiButton', array(
				'name'=>'ajaxContinueLoginButton',
				'caption'=>Yii::t('site', 'I accept, continue'),
				'id'=>'continueLoginAjaxButton-'.uniqid(), //Unique ID oluşturmayınca her ajaxta bir önceki sorgular da tekrarlanıyor
				'htmlOptions'=>array('type'=>'submit',
									 'ajax'=>array('url'=>$this->createUrl('site/continueLogin', array('LoginForm'=>$form)),
												   'success'=>'function(msg){
																try
																{
																	var obj = jQuery.parseJSON(msg);
												
																	if (obj.result)
																	{
																		if (obj.result == "1")
																		{
																			$("#acceptTermsForLoginWindow").dialog("close");
									 										$("#tabViewList").html(obj.renderedTabView);
																			$("#forAjaxRefresh").html(obj.loginSuccessfulActions);
																		}
																	}
																}
																catch (error)
																{
																	$("#forAjaxRefresh").html(msg);
																}
															}',
				))
		));		
		
		?>
											
		<?php			 
			$this->widget('zii.widgets.jui.CJuiButton', array(
					'name'=>'cancelLogin',
					'caption'=>Yii::t('common', 'Cancel'),
					'id'=>'cancelLoginButton',
					'onclick'=> 'js:function(){$("#acceptTermsForLoginWindow").dialog("close"); return false;}'
			));		
		?>												
	</div>
<?php 
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>