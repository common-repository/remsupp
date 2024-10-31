<?php if ( isset($integrateActionUrl) ) { ?> 
<script type="application/javascript">
        window.addEventListener('message', message => {
            if (message.origin !== '<?php echo esc_url_raw(RemSuppConfig::getBaseUrl()) ?>') return;  
            if (message.data.type === 'integrate') {
                jQuery.ajax({
                        url: '<?php echo esc_url_raw($integrateActionUrl) ?>',
                        type: 'POST',
                        data: JSON.stringify({companyId: message.data.companyId}),
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function(result){
                                console.log(result);
                        },
                        error: function(e){
                                console.log(e);
                        }
                }); 
            }
        });
</script>
<?php } ?>        

<?php if ( isset($iframeUrl) ) { ?> 
<iframe
        style="overflow:hidden; height:calc(100vh - 111px); min-height: 620px; width:100%"
        width="100%"
        src="<?php echo esc_url_raw($iframeUrl) ?>">
</iframe>
<?php } ?>   