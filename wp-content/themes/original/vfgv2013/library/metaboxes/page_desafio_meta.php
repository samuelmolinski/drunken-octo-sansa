<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
	<label>Estado</label>
	<?php $metabox->the_field('status'); ?>
	<select name="<?php $metabox->the_name(); ?>">
		<option value="">Selecione...</option>
		<option value="locked"<?php $mb->the_select_state('locked'); ?>>Fechada</option>
		<option value="active"<?php $mb->the_select_state('active'); ?>>Ativar</option>
		<option value="closed"<?php $mb->the_select_state('closed'); ?>>Encerrado</option>
	</select>	
	
	<label>Share Title (Facebook)</label>
	<p><?php $metabox->the_field('shareTitle'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /></p>    
    
	<label>Frase do Share (Facebook)</label>
	<p><?php $metabox->the_field('shareFrase'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /></p>
    
	<label>Frase do Input</label>
	<p><?php $metabox->the_field('inputFrase'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /></p>        
    
     <label>Data de Incío</label> 
     <p><?php $metabox->the_field('dateStart'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /><span>Digite a data de término do incío, num formato a ser visto pelos usuários. Exemplo: dd / mm / aaaa</span></p>
	
	<label>Data de Término</label> 
	<p><?php $metabox->the_field('dateEnd'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /><span>Digite a data de término do desafio, num formato a ser visto pelos usuários. Exemplo: dd / mm / aaaa</span></p>
	
	<label>Link de Vídeo</label>
	<p><?php $metabox->the_field('linkVideo'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /><span>Link para o vídeo do YouTube</span></p>	
	
	<label>Link da Imagem do Share</label>
	<p><?php $metabox->the_field('fb_post_image'); ?><?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?></p> 
    <p><?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><?php echo $wpalchemy_media_access->getButton(); ?></p>
    
	<label>Link da Imagem da Home</label>
	<p><?php $metabox->the_field('fb_post_image_home'); ?><?php $wpalchemy_media_access->setGroupName('img-h'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?></p> 
    <p><?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><?php echo $wpalchemy_media_access->getButton(); ?></p>  
    
	<label>Link da Imagem do Prêmio</label>
	<p><?php $metabox->the_field('fb_post_image_premio'); ?><?php $wpalchemy_media_access->setGroupName('img-p'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?></p> 
    <p><?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><?php echo $wpalchemy_media_access->getButton(); ?></p>        
    
	<div class="clear"></div>
</div>