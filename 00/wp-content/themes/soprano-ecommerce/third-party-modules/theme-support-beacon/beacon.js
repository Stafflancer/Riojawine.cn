/* ============================================================================= */
/* Equip Beacon. */
/* ============================================================================= */
!function(e,o,n){window.HSCW=o,window.HS=n,n.beacon=n.beacon||{};var t=n.beacon;t.userConfig={},t.readyQueue=[],t.config=function(e){this.userConfig=e;},t.ready=function(e){this.readyQueue.push(e);},o.config={docs:{enabled:!1,baseUrl:""},contact:{enabled:!0,formId:"64ee0c1a-a694-11e7-b466-0ec85169275a"}};var r=e.getElementsByTagName("script")[0],c=e.createElement("script");c.type="text/javascript",c.async=!0,c.src="https://djtflbt20bdde.cloudfront.net/",r.parentNode.insertBefore(c,r);}(document,window.HSCW||{},window.HS||{});


/* ============================================================================= */
/* Configure Beacon. */
/* ============================================================================= */
HS.beacon.config({
    instructions     : 'Here you can write message for PuzzleThemes support team if you have any suggestions or questions about theme.',
    showContactFields: true,
    poweredBy        : false,
    showSubject      : true,

    topics: [
        {val: 'demo-install', label: 'Demo data setup assistance'},
        {val: 'need-help', label: 'Help with the theme needed'},
        {val: 'paid-support', label: 'Paid support request'},
        {val: 'bug-found', label: 'Bug report'}
    ],

    translation: {
        contactSuccessDescription: 'Thanks for reaching out! Our dev team will get back to you soon.'
    }
});


/* ============================================================================= */
/* Pass data into Beacon. */
/* ============================================================================= */
HS.beacon.ready(function () {
    var php_data = PZT_BEACON_DATA,
        identify_data = {
            email              : php_data.user_email,
            'Theme Name'       : php_data.theme_name,
            'Theme Version'    : php_data.theme_version,
            'WordPress Version': php_data.site_wp_version,
            'Site URL'         : php_data.site_url
        };

    if (php_data.user_name) {
        identify_data.name = php_data.user_name;
    }

    HS.beacon.identify(identify_data);

    jQuery(window).trigger('pzt.beacon-loaded');
});