<template>
<div>
    <div class="container">
    <!-- <div class="row justify-content-center"> -->
        <!-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                
                   <ul>
                   <li>Step 1:Build your database
                       <h3>Data Setup</h3>
                        Enter the nescessary data for creating transaction such as Vendors, Customers and Items. 
                   </li>
                   <li>Step 2:Begining Balance</li>
                   <h3>Purchase Order</h3>
                        Using the purchase order form enter your Begining balances of Inventory ans set the status to approved.
                   <li>Step 3:Inventory</li>
                    <h3>Receiving</h3>
                        Receiving the approved PO is the last set so you can account the Inventory as ready to issue stocks.
                   <li>Step 4:</li>
                   <li>Step 5:</li>
                   </ul>
                </div>
            </div>
        </div>
        <hr>  -->
        
        <p id="titlex" class="display-4 text-muted"> System Quick Guide</p>

    <b-row>
        <b-col>
            <b-card
                header=" Step 1: Build your database"
                header-tag="header"
                title="Data Setup"
                >
                <b-card-text> Enter the nescessary data for creating transaction such as Vendors, Customers and Items. </b-card-text>
                <b-button href="#" variant="outline-secondary">Start Data Setup</b-button>
            </b-card>
        </b-col>
        <b-col> 
             <b-card
                header=" Step 2: Begining Balance"
                header-tag="header"
                title="Purchase Order"
                >
                <b-card-text> Using the purchase order form enter your Begining balances of Inventory ans set the status to approved. </b-card-text>
                <b-button href="#" variant="outline-secondary">Make Purchase Order</b-button>
            </b-card>
        </b-col>
        <b-col>
             <b-card
                header="Step 3: Inventory"
                header-tag="header"
                title="Receiving"
                >
                <b-card-text> Receiving the approved PO is the last set so you can account the Inventory as ready to issue stocks. </b-card-text>
                <b-button href="#" variant="outline-secondary">Check Received Items</b-button>
            </b-card>
        </b-col>
    </b-row>
    <br>
    <b-row>
        <b-col>
             <b-card
                header="Step 4:"
                header-tag="header"
                title="Title"
                >
                <b-card-text>Header and footers using props.</b-card-text>
                <b-button href="#" variant="outline-secondary">Go somewhere</b-button>
            </b-card>
        </b-col>
        <b-col>
             <b-card
                header="Step 5:"
                header-tag="header"
                title="Title"
                >
                <b-card-text>Header and footers using props.</b-card-text>
                <b-button href="#" variant="outline-secondary">Go somewhere</b-button>
            </b-card>
        </b-col>
        <b-col>
             <b-card
                header="Step 6:"
                header-tag="header"
                title="Title"
                >
                <b-card-text>Header and footers using props.</b-card-text>
                <b-button href="#" variant="outline-secondary">Go somewhere</b-button>
            </b-card>
        </b-col>
    </b-row>
<!-- </div> -->
</div>
</div>
</template>
<script>
export default {
    methods:{
      
    }
}
</script>
<style scoped>
ul li{
    list-style: none;
}
#titlex{
    margin: 80px 0px 100px 0px;
    text-align: center;
}
</style>
