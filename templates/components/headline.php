<?php get_header(); ?>
<?php
$headline = get_sub_field('headline');
$headline2 = get_sub_field('headline2');
?>

<?php the_post_thumbnail(); ?>
 <section class="rubriker rubriker_rubriker">
   <div class="input-text-wrapper">
     <div class="container">
       <div class="ruta col-sm-12">
       <div class="row row-row">

         <div class="rubriker1 col-sm-4">
           <?php echo $headline; ?>
         </div>

         <!-- <div class="rubriker2 col-sm-4">
           <?php echo $headline2; ?>
         </div> -->
       </div>
     </div>
     </div>
   </div>
 </section>
