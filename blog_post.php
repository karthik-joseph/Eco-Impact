<?php include 'header.php' ?>
<style>
    body {
        background: var(--secondary-bg-color);
    }
</style>
<section id="blog_post">
    <section class="blog_post_spotlight">
        <div class="left_flower_container">
            <div class="first_flower">
            <img src="images/icons/leaf-brown.svg" alt="plant leaf image" />
              
            </div>
            <div class="second_flower">
            <img src="images/icons/leaf.svg" alt="Branch Leaf" />
            </div>
        </div>
        <!-- #blog_post > .blog_post_spotlight > .left_flower_container -->
        <div class="content_container">
            <h2>Reduce Your Environmental Footprint</h2>
            <h1>Measure Your Impact: Our Eco-Impact</h1>
            <p>Discover practical tips to lower your carbon footprint and live more sustainably</p>
        </div>
        <!-- #blog_post > .blog_post_spotlight >.content_container -->
        <div class="right_flower_container">
            <img src="images/icons/flower-pot.png" alt="Flower Pot" />
        </div>
        <!-- #blog_post > .blog_post_spotlight > .right_flower_container -->
    </section>
    <!-- #blog_post > .blog_post_spotlight -->
     <section class="about_our_mission">
        <h2>About Our Mission</h2>
        <p>we're dedicated to empowering individuals to reduce their environmental impact through our innovative eco-tracking tools</p>
        <ul>
        <?php
            $ab = "select * from products";
            $obj = select($ab);
            foreach($obj as $i) {
        ?>
            <li>
                <h3><?php echo $i['product_name']; ?></h3>
            </li>
            <?php }?>
        </ul>
     </section>
</section>
<!-- .blog_post -->
<script src="js/script.js"></script>
<?php include 'footer.php' ?>