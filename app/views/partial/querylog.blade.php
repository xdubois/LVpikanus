<script type="text/javascript">
    var queries = {{ json_encode(DB::getQueryLog()) }};
    var queries_count = 0;
    var queries_time = 0;
    console.log('/****************************** Database Queries ******************************/');
    console.log('');
    queries.forEach(function(query) {
    	binding = (typeof query.bindings[0]) === "undefined" ? '' : query.bindings[0];
        console.log('   ' +  query.time + ' | ' + query.query + ' | ' + binding );
        queries_count++;
        queries_time += query.time;
    });
    console.log(queries_count + ' queries | ' + queries_time + ' sec');
    console.log('');
    console.log('/****************************** End Queries ***********************************/');
</script>