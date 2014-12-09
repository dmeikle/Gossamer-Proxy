
gossamerCMS V2
===========
moving components into segregated groupings....

REST based CMS system

**this is a work in progress as a proof of concept only. I am currently implementing a ton of items into this
offline with full validation found here: https://github.com/dmeikle/validation/ <br>
I now have PHPUnit installed on Windows Vista with WAMP so I can now commence Test Driven Development from my home
as I am writing this in evenings in my spare time - the validation now has unit tests written.<br><br>


This is a work in progress - currently set as an Alpha release. 
This project is a development site for testing the RESTful API written 
to offer a central repository database accessible through REST calls.
This part of the project is the client website which relies on a REST API
to query all of its content as well as admin CRUD (create update delete).

The time to write this using a java struts style MVC framework with XML 
was about 15 minutes of drawing on paper, then approximately 8 hours of 
writing and testing. I tried to keep it minimal in its approach with as
little code as possible for maximum effect. 1 controller can perform the majority
of menial tasks (findall, delete, view..), but since this is MVC there are 
a few extra controllers for overriding the standard controller when something
a bit custom was needed.

The /core folder contains the main functional abstract classes that the rest of the
site is extended from. To point to the RESTful database API (separate project) you
will need to modify the settings inside the /classes/core/AbstractModel.php file:
<pre>
public function query($queryType, $entity, $verb, $params) {
	//TODO - make this a config file value
   $api = new RestClient(gossamerCMS
===========

REST based CMS system


This is a work in progress - currently set as an Alpha release. 
This project is a development site for testing the RESTful API written 
to offer a central repository database accessible through REST calls.
This part of the project is the client website which relies on a REST API
to query all of its content as well as admin CRUD (create update delete).

The time to write this using a java struts style MVC framework with XML 
was about 15 minutes of drawing on paper, then approximately 8 hours of 
writing and testing. I tried to keep it minimal in its approach with as
little code as possible for maximum effect. 1 controller can perform the majority
of menial tasks (findall, delete, view..), but since this is MVC there are 
a few extra controllers for overriding the standard controller when something
a bit custom was needed.

The /core folder contains the main functional abstract classes that the rest of the
site is extended from. To point to the RESTful database API (separate project) you
will need to modify the settings inside the /classes/core/AbstractModel.php file:
<pre>
public function query($queryType, $entity, $verb, $params) {

	$filepath = __SITE_PATH . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .
    	'config' . DIRECTORY_SEPARATOR . 'restcredentials';
    	
		//this will load the credentials based on entity resource. if not
		//specified in the xml it will return the default credentials to us.
		//this allows multiple resources for various entities in the system.		
    	$parser = new XMLDefaultParser($filepath);
		$credentials = $parser->findNodeByEntityName($entity,'all');
    	unset($parser);
    	
 	$api = new RestClient(array(
            'base_url' => $credentials['baseUrl'],
            'format' => $credentials['format'],
            'headers' => $credentials['headers']
        ));
}
</pre>
RC1.2.0 The credentials are now stored in a separate XML file. The DEFAULT node is the regular credentials for 
all REST API database requests. This can be overridden on a 'per Entity' level (eg: your Blog section may
access a different remote resource, or your NewsUpdates may pull from a separate server where you have a client
level agreement with a different provider). Below is a mockup of the default for all DB requests and a sample
showing that the Blog is being overridden by a different remote resource for all of its requests:
```xml
<?xml version="1.0"?>
<credentialsList>
	
	<page uri="DEFAULT">
		<all>
			<param name="baseUrl">http://your-rest-api-listening-domain-goes-here</param>
			<param name="format">json</param>
			<param name="headers">
				<header name="Authorization">your Authorization token here</header>
				<header name="serverAuth">your domain/server identity token here</header>
			</param>		
		</all>
	</page>
	
	<page uri="Blogs">
		<all>
			<param name="baseUrl">http://your-rest-api-listening-domain-goes-here</param>
			<param name="format">json</param>
			<param name="headers">
				<header name="Authorization">your Authorization token here</header>
				<header name="serverAuth">your domain/server identity token here</header>
			</param>		
		</all>
	</page>
	
</credentialsList> 
```

The simplicty of this CMS is based on its java struts styled XML configuration,
which is located in the /classes/config/web.xml file.
The controllers/models/methods are specified in the XML file, mapped by the
browser $_REQUEST URI as follows:
```xml
<page uri="/great-recipes">
	<callables>
		<callable name="controller">Blog</callable>
		<callable name="model">Blog</callable>
		<callable name="method">listall</callable>
	</callables>
</page>
```
You may notice the downloadable web sample is for spectralcow.com - a paranormal
research team website - hahaha... yes... I was writing this from scratch and needed
a guinea pig website. So I thank a few of my friends at ColdSpotters for letting me
do a site for them one night.

Navigation is set through the /classes/core/AbstractModel.php (for now). This was written on the fly one night
and most likely I will move this into a configurable XML file using the CMS to set its 
values. It seemed like a good idea at the time until I started doing the admin section for
CRUD on the Blog - suddenly I needed to create an AdminModel that overrode the values
of the navigation - not very elegent, so I will work that out later - essentially I didn't like
multiple instance of nav menu hidden throughout the site.

Templates - the site is driven using a couple of templates inside of /templates/master folder. They use
placeholders for content <pre><!---leftnavigation---></pre> for example. These can be modified at will
and new sections added inside the model itself:
<pre>
public function index(){
    $this->view->addSection('leftnavigation', 'admin/blog/adminsubnav');
    $this->view->addSection('content', 'admin/blog/listall');
    $this->render('master/admin', null);
}
</pre>

The above sample says 'look for a tag in the template called <pre><!---leftnavigation---></pre> and replace that 
area with the views/admin/blog/leftnavigation.php file'. Then do the same for <pre><!---content---></pre>
using the views/admin/blog/listall.php file. Once you have those referenced, render the results to the 
templates/master/admin.php file.


array(
        'base_url' => "http://insert-rest-url-here",
        'format' => "json",
        'headers' => array(
            'Authorization' => 'client-auth-token-here',
            'serverAuth' => 'server-auth-token-here'

        )
    ));
}
</pre>

**note: this will change! Each Model will be able to access a variety of data resources, this single method query
will be modified to allow for dependency injection to provide which resource and credentials to access. This will be
configurable through a separate file based on URI and/or Model.

The simplicty of this CMS is based on its java struts styled XML configuration,
which is located in the /classes/config/web.xml file.
The controllers/models/methods are specified in the XML file, mapped by the
browser $_REQUEST URI as follows:
```xml
<page uri="/great-recipes">
	<callables>
		<callable name="controller">Blog</callable>
		<callable name="model">Blog</callable>
		<callable name="method">listall</callable>
	</callables>
</page>
```
You may notice the downloadable web sample is for spectralcow.com - a paranormal
research team website - hahaha... yes... I was writing this from scratch and needed
a guinea pig website. So I thank a few of my friends at ColdSpotters for letting me
do a site for them one night.

Navigation is set through the /classes/core/AbstractModel.php (for now). This was written on the fly one night
and most likely I will move this into a configurable XML file using the CMS to set its 
values. It seemed like a good idea at the time until I started doing the admin section for
CRUD on the Blog - suddenly I needed to create an AdminModel that overrode the values
of the navigation - not very elegent, so I will work that out later - essentially I didn't like
multiple instance of nav menu hidden throughout the site.

Templates - the site is driven using a couple of templates inside of /templates/master folder. They use
placeholders for content <pre><!---leftnavigation---></pre> for example. These can be modified at will
and new sections added inside the model itself:
<pre>
public function index(){
    $this->view->addSection('leftnavigation', 'admin/blog/adminsubnav');
    $this->view->addSection('content', 'admin/blog/listall');
    $this->render('master/admin', null);
}
</pre>

The above sample says 'look for a tag in the template called <pre><!---leftnavigation---></pre> and replace that 
area with the views/admin/blog/leftnavigation.php file'. Then do the same for <pre><!---content---></pre>
using the views/admin/blog/listall.php file. Once you have those referenced, render the results to the 
templates/master/admin.php file.



