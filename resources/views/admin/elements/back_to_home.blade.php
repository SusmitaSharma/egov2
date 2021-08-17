 <!-- Content Header (Page header) -->
 <section class="content-header">
        <h1>
        {{isset($routeType)?ucwords($routeType):'Dashboard'}}
            <small><a href="{{ url()->previous() }}">पछाडि फर्कने</a></small>
        </h1>

    </section>
