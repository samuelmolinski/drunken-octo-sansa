<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
	<label>Estado</label>
	<span style="margin-left: 6px;">"Fechado" (inacessível), "Ativar" para ficar aberto a respostas e "Encerrado" para finalizar. Se um vencedor for escolhido ele só é apresentado no estado "Encerrado"</span>
	<?php $metabox->the_field('status'); ?>
	<select name="<?php $metabox->the_name(); ?>">
		<option value="">Selecione...</option>
		<option value="locked"<?php $mb->the_select_state('locked'); ?>>Fechada</option>
		<option value="active"<?php $mb->the_select_state('active'); ?>>Ativar</option>
		<option value="closed"<?php $mb->the_select_state('closed'); ?>>Encerrado</option>
	</select>	
	
	<label>Share Title (Facebook)</label>
	<p>
	<span style="margin-left: 6px;">Título que aparece depois de "Vestibular FGV 2013-2 -" no post que fazemos no mural do usuário</span>
	<?php $metabox->the_field('shareTitle'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /></p>    
    
	<label>Frase do Share (Facebook)</label>
	<p>
	<span style="margin-left: 6px;">Frase que aparece abaixo do Share Title no post que fazemos no mural do usuário</span>
	<?php $metabox->the_field('shareFrase'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /></p>
    
	<label>Frase do Input</label>
	<p>
	<span style="margin-left: 6px;">Frase que aparece convocando o usuario a responder no box de resposta. Aceita html.</span>
	<?php $metabox->the_field('inputFrase'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /></p>        
    
    <!-- <label>Data de Incío</label> 
     <p>
	<span style="margin-left: 6px;"></span>
	<?php $metabox->the_field('dateStart'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /><span>Digite a data de término do incío, num formato a ser visto pelos usuários. Exemplo: dd / mm / aaaa</span></p>
	
	<label>Data de Término</label> 
	<p>
	<span style="margin-left: 6px;"></span>
	<?php $metabox->the_field('dateEnd'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /><span>Digite a data de término do desafio, num formato a ser visto pelos usuários. Exemplo: dd / mm / aaaa</span></p>
	 -->
	<label>Link de Vídeo</label>
	<p>
	<span style="margin-left: 6px;">Link para o vídeo do YouTube</span>
	<?php $metabox->the_field('linkVideo'); ?><input type="text" name="<?php $metabox->the_name(); ?>"  value="<?php $mb->the_value(); ?>" /></p>	
	
	<label>Link da Imagem do Share</label>
	<p>
	<span style="margin-left: 6px;">Imagem que é publicada no mural do usuário abaixo do Frase do Share (Facebook)</span>
	<?php $metabox->the_field('fb_post_image'); ?><?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
	<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><?php echo $wpalchemy_media_access->getButton(); ?></p>
    
	<label>Link da Imagem da Home</label>
	<p>
	<span style="margin-left: 6px;">Imagem na home com a chamada para o desafio</span>
	<?php $metabox->the_field('fb_post_image_home'); ?><?php $wpalchemy_media_access->setGroupName('img-h'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
	<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><?php echo $wpalchemy_media_access->getButton(); ?></p>  
    
	<label>Link da Imagem do Prêmio</label>
	<p>
	<span style="margin-left: 6px;">Imagem que vai ao lado do vídeo, normalmente falando dos prêmios</span>
	<?php $metabox->the_field('fb_post_image_premio'); ?><?php $wpalchemy_media_access->setGroupName('img-p'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
	<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><?php echo $wpalchemy_media_access->getButton(); ?></p>        
    
	<div class="clear"></div>
</div>