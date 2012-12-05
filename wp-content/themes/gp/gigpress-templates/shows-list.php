<?php	 		 		 	

// This template displays all of our individual show data in the main shows listing (upcoming and past).
// It's marked-up in hCalendar format, so fuck-around with caution.
// See http://microformats.org/wiki/hcalendar for specs

//	If you're curious what all variables are available in the $showdata array,
//	have a look at the docs: http://gigpress.com/docs/

?>

<tbody class="vevent">
	
	<tr class="gigpress-row <?php echo $class; ?>">
	
		<td class="gigpress-date">
			<span class="tape<?= ($showdata['end_date']) ? ' mdate' : '' ?>">
			<?php	 		 		 	
			// Only show these links if this show is in the future
			if($scope != 'past') : ?>
			<div class="gigpress-calendar-add">
				<a class="gigpress-links-toggle" href="#calendar-links-<?php echo $showdata['id']; ?>">Add</a>
				<div class="gigpress-calendar-links" id="calendar-links-<?php echo $showdata['id']; ?>">
					<div class="gigpress-calendar-links-inner">
						<span><?php	echo $showdata['gcal']; ?></span>
						<span><?php echo $showdata['ical']; ?></span>
					</div>
				</div>
			</div>
			<?php endif; ?>			
			
			<abbr class="dtstart" title="<?= $showdata['iso_date']; ?>"><?= $showdata['date']; ?></abbr>
		<?php if($showdata['end_date']): ?><abbr class="dtend" title="<?= $showdata['iso_end_date']; ?>"><br/> - <?= $showdata['end_date']; ?>
			</abbr><?php endif; ?>
			</span>
		</td>
		
	<?php if((!$artist && $group_artists == 'no') && $total_artists > 1) : ?>
		<td class="gigpress-artist">
			<?php echo $showdata['artist']; ?>
		</td>
	<?php endif; ?>
	
		<td class="gigpress-city summary">
			<span class="hide"><?php echo $showdata['artist']; ?> <?php	 _e("in", "gigpress"); ?> </span>
			<?php echo $showdata['city']; ?>
		</td>
		
		<td class="gigpress-venue location<?php	 if($venue) : ?> hide<?php	endif; ?>"><?php	 		 		 	 echo $showdata['venue']; ?></td>
		
	<?php	if ($gpo['display_country'] == 1): ?>
		<td class="gigpress-country"><?php	echo $showdata['country']; ?></td>
	<?php	else: ?>
		<td class="gigpress-tickets">
	<?php if ($showdata['price']): ?><span class="gigpress-info-item"><?= $showdata['price']; ?></span><?php	 		 		 	 endif; ?>
		</td>
	<?php endif; ?>
	
	</tr>
	
	<tr class="gigpress-info <?php echo $class; ?>">
	
		<td class="gigpress-links-cell">
		</td>
		
		<td colspan="<?php echo $cols - 1 ?>" class="description">
		
			<?php if($showdata['time']) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Time", "gigpress"); ?>:</span> <?php echo $showdata['time']; ?></span>
			<?php	endif; ?>
			
			<?php if($showdata['price'] && $gpo['display_country'] == 1) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Admission", "gigpress"); ?>:</span> <?php echo $showdata['price']; ?></span>
			<?php endif; ?>
			
			<?php if($showdata['admittance']) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Ages", "gigpress"); ?>:</span> <?php echo $showdata['admittance']; ?></span>
			<?php endif; ?>
			<?php if($showdata['ticket_phone']) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Box office", "gigpress"); ?>:</span> <?php echo $showdata['ticket_phone']; ?></span>
			<?php endif; ?>
			
			<?php if($showdata['venue_phone']) : ?>
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Venue phone", "gigpress"); ?>:</span> <?php echo $showdata['venue_phone']; ?></span>
			<?php endif; ?>					
			<?php if($showdata['address']) : ?> 
				<span class="gigpress-info-item"><span class="gigpress-info-label"><?php _e("Address", "gigpress"); ?>:</span> <?php echo $showdata['address']; ?>.</span>
			<?php endif; ?>		
			
			<?php if($showdata['related_link']) : ?>
				<span class="gigpress-info-item tape medium_tape"><?php echo $showdata['related_link']; ?></span> 
			<?php endif; ?>
			
			<?php if($showdata['ticket_link'] && $gpo['display_country'] == 1) : ?>
				<span class="gigpress-info-item"><?php echo $showdata['ticket_link']; ?></span>
			<?php endif; ?>
			<?php if($showdata['notes']) : ?>
				<br/><span class="gigpress-info-item gigpress-info-notes"><?php	 		 		 	 echo $showdata['notes']; ?></span>
			<?php endif; ?>			
		</td>
		<?php if ($gpo['display_country'] != 1): ?><td>
			<?php if ($showdata['ticket_link']): ?><span class="tape medium_tape"><?php	 		 		 	 echo $showdata['ticket_link']; ?></span><?php	 		 		 	 endif; ?>	
		</td><?php	endif ?>
	</tr>
</tbody>	
