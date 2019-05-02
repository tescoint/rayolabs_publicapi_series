<?php
require_once(ABSPATH . 'wp-config.php'); 
require_once(ABSPATH . 'wp-includes/wp-db.php'); 
require_once(ABSPATH . 'wp-admin/includes/taxonomy.php');
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://facebook.com/tsal3
 * @since      1.0.0
 *
 * @package    Rayolabs_publicapi_series
 * @subpackage Rayolabs_publicapi_series/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rayolabs_publicapi_series
 * @subpackage Rayolabs_publicapi_series/public
 * @author     Tes Sal <tescointsite@gmail.com>
 */
class Rayolabs_publicapi_series_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $api_url ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->api_url = $api_url;
		$this->options = get_option($this->plugin_name);

	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rayolabs_publicapi_series_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rayolabs_publicapi_series_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rayolabs_publicapi_series-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rayolabs_publicapi_series_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rayolabs_publicapi_series_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rayolabs_publicapi_series-public.js', array( 'jquery' ), $this->version, false );

	}
	public function pull_post($wp){
		if (array_key_exists('my-plugin', $wp->query_vars) 
            && $wp->query_vars['my-plugin'] == $this->plugin_name) {
							$data = json_decode(file_get_contents('php://input'), true);
				$token = $data['site_token'];
				// print_r($data['data'][0]);die;
       	    	if($token == $this->options['site_token']){
    		//That MEans PaperAdmin Has been verified now lets process this posted post
				$post = $data['data'][0];
				$post = json_encode($post);
    		 $post = json_decode($post);
    		//  print_r($post);die;
			// //Now Lets Add That to db
			// return [
			// 	'id' => $this->id,
			// 	'serie' => $this->serie,
			// 	'name' => $this->series->name,
			// 	'season' => $this->season,
			// 	'episode' => $this->episode,
			// 	'episode_link' => $this->episode_link,
			// 	'hd' => str_replace(' ',"%20", $data['hd']),
			// 	'mp4' => str_replace(' ',"%20", $data['mp4']),
			// 	'3gp' => str_replace(' ',"%20", $data['3gp']),
			// ];
    		 $source = ucfirst($post->serie);
    		 $title = $post->name." Season ".$post->season." Episode ".$post->episode_link;
    		 $excerpt = "Download or Watch ".$title;
    		 $entry_time = date('Y-m-d H:i:s');
			 $hd = $post->hd;
			 $mp4 = $post->mp4;
			 $low = $post->{'3gp'};
    		 $content = $post->content;
    		 $category = $post->name;
    		 $tags 		= $source;
			
    		 $featured_image = $post->image_link;
    		 if($this->options['categories'] == 'yes'){
    		 //Check If Category Exist If not Create Them
    		 $category_id = get_cat_ID($category);
    		 if($category_id == 0){
    		 	$category_id = wp_create_category($category);
    		 }
			}
			$content = "";
    		     		 //Check If to post full content or excerpt
    		 if($this->options['post_type'] == 'wd'){
				$content .= "[video src='$hd']";
    		 }
				$content .= "<br><a href='https://nullrefer.com/?$hd'>Download Hd</a> ";
				$content .= "<br><a href='https://nullrefer.com/?$mp4'>Download Mp4</a> ";
				$content .= "<br><a href='https://nullrefer.com/?$low'>Download 3gp</a> ";
			 
			 
    		  $postarr = array(
				  'post_title'    => wp_strip_all_tags( $title),
				  'post_content'  => $content,
				  'post_excerpt' => $excerpt,
				  'post_status'   => 'publish',
				  'post_author'   => 1,

    		 	);
    		   if($this->options['categories'] == 'yes'){
    		   	$postarr['post_category'] = array($category_id );
    		   }
    		 $check = get_page_by_title($title,'OBJECT','post');
    		 if(empty($check)){
    		  $post_id = wp_insert_post($postarr,true);
    		 if(!empty($featured_image)){
    		 $this->Generate_Featured_Image( $featured_image ,   $post_id );
    		 }
    		 if(!empty($tags)){
    		 	wp_set_post_tags( $post_id, $tags);
    		 } 
    		 }
    		 // wp_create_category( $cat_name, $parent );
    		// get_cat_ID('Category Name')
    		if(empty($check) and $post_id == 0){
    			die('unprocessed');
    		}else{
    			die('processed');
    		}
    		}else{
					die("Japa MotherFucker");
				}
        // process the request.
        // For now, we'll just call wp_die, so we know it got processed
        //wp_die('my-plugin ajax-handler!');
    }
		
    }


    public function Generate_Featured_Image( $image_url, $post_id  ){
    $upload_dir = wp_upload_dir();
    //$image_data = file_get_contents($image_url);
    // header("Content-Type: image/jpeg");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $image_url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
	$image_data = curl_exec($ch);
	// $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
	// curl_close($ch) ;
	// echo $res;
    $filename = md5(basename($image_url)).".png";
    if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);
	
    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2= set_post_thumbnail( $post_id, $attach_id );
}
	public function my_plugin_query_vars($vars) {
    $vars[] = 'my-plugin';
    return $vars;
}

}
