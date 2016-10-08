<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_miniuniversity
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
?>
<form action="<?php echo JRoute::_('index.php?option=com_crocodilecontent&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate"enctype="multipart/form-data">
	



	<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>
    	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_BACKPIC_FILTER_DETAILS_CONTENT', true)); ?>

    <div class="form-horizontal">
				<div class="row-fluid">
					<div class="span12">
					<p>
					<?php echo JText::_('COM_BACKPIC_FILTER_DETAILS'); ?>
					</p>
					<p>
					<?php echo JText::_('COM_BACKPIC_FILTER_OTHER_COM'); ?>
					</p>
					<hr>
							<div class="control-group">
							<?php echo $this->form->getInput('id'); ?>
								<div class="control-label"> <?php echo $this->form->getLabel('name'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
							</div>
							
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('article_id'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('article_id'); ?></div>
							</div>
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('type'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('type'); ?></div>
							</div>
							<!--  -->
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('published'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('published'); ?></div>
							</div>
							<!--  -->
							<hr>
							<p>
							<?php echo JText::_('COM_CROCODILECONTENT_FILTER_FORMAT_BACKPIC'); ?>
							</p>
							<p>
							<?php echo JText::_('COM_BACKPIC_FILTER_FORMAT'); ?>
							</p>
							<hr>
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('pic'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('pic'); ?></div>
							</div>
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('width'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('width'); ?></div>
							</div>
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('height'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('height'); ?></div>
							</div>
							<!--  -->
							
							<hr>
							
							
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('custom'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('custom'); ?></div>
							</div>
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('template_name'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('template_name'); ?></div>
							</div>
							<hr>
							<p id="labelal">
							<?php echo JText::_('COM_CROCODILECONTENT_FORMAT_LABEL'); ?>
							</p>
							<hr>
							<!--  -->
							<div id = "lb_apear">
							<div class="control-group" id="lb_name">
								<div class="control-label"> <?php echo $this->form->getLabel('label_name'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('label_name'); ?></div>
							</div>
							<!--  -->
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('first_day'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('first_day'); ?></div>
							</div>
							<!--  -->
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('last_day'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('last_day'); ?></div>
							</div>
							</div>
							<!--  -->
							<hr>
							<p id="labelal">
							<?php echo JText::_('COM_CROCODILECONTENT_SECOND_TTL_SIGN_LABEL'); ?>
							</p>
							<hr>
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('second_ttl'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('second_ttl'); ?></div>
							</div>
							<!--  -->
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('sign'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('sign'); ?></div>
							</div>
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('attached_file'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('attached_file'); ?></div>
							</div>
							<!--  -->
							<div class="control-group">
								<div class="control-label"> <?php echo $this->form->getLabel('show_id'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('show_id'); ?></div>
							</div>
					</div>
				</div>
	</div>
	
    	<?php echo JHtml::_('bootstrap.endTab'); ?>
    	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'advanced', JText::_('COM_BACKPIC_FILTER_DETAILS_MENU', true)); ?>
		<?php echo JText::_('COM_BACKPIC_FILTER_OTHER_TRANGELL'); ?>
    	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php echo JHtml::_('bootstrap.endTabSet'); ?>



	<input type="hidden" name="task" value="listpic.edit" />
	<?php echo JHtml::_('form.token'); ?>
</form>
