
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

<style>
    /**
 * Invoice Style Sheet
 *
 * Contains styling specific to the view invoice page.
 *
 * @project   WHMCS
 * @version   1.0
 * @author    WHMCS Limited <development@whmcs.com>
 * @copyright Copyright (c) WHMCS Limited 2005-2015
 * @license   http://www.whmcs.com/license/
 * @link      http://www.whmcs.com/
 */

body {
    background-color: #efefef;
}

/* Container Responsive Behaviour */

@media print {
    html, body {
        width: 750px;
    }
}

.invoice-container {
    margin: 15px auto;
    padding: 70px;
    max-width: 850px;
    background-color: #fff;
    border: 1px solid #ccc;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    -o-border-radius: 6px;
    border-radius: 6px;
}

@media (max-width: 895px) {
    .invoice-container {
        margin: 15px;
    }
}
@media (max-width: 767px) {
    .invoice-container {
        padding: 45px 45px 70px 45px;
    }
}

@media (max-width: 499px) {
    .invoice-header {
        text-align: center;
    }
}

.invoice-col {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}

@media (min-width: 500px) {
    .invoice-col {
        float: left;
        width: 50%;
    }
    .invoice-col.right {
        float: right;
        text-align: right;
    }
}

/* Invoice Status Formatting */

.invoice-container .invoice-status {
    margin: 20px 0 0 0;
    text-transform: uppercase;
    font-size: 24px;
    font-weight: bold;
}

/* Invoice Status Colors */

.draft {
    color: #888;
}
.unpaid {
    color: #cc0000;
}
.paid {
    color: #779500;
}
.refunded {
    color: #224488;
}
.rejected {
    color: #888;
}
.collections {
    color: #ffcc00;
}

/* Payment Button Formatting */

.invoice-container .payment-btn-container {
    margin-top: 5px;
    text-align: center;
}
.invoice-container .payment-btn-container table {
    margin: 0 auto;
}

/* Text Formatting */

.invoice-container .small-text {
    font-size: 0.9em;
}

/* Invoice Items Table Formatting */

.invoice-container td.total-row {
    background-color: #f8f8f8;
}
.invoice-container td.no-line {
    border: 0;
}
.invoice-container .invoice-header img {
    max-width: 100%;
}

/* Overlay */

#fullpage-overlay {
    display: table;
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: black;
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
}
#fullpage-overlay .outer-wrapper {
    position: relative;
    height: 100%;
}
#fullpage-overlay .inner-wrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    height: 30%;
    width: 50%;
    margin: -3% 0 0 -25%;
    text-align: center;
}
#fullpage-overlay .msg {
    display: inline-block;
    padding: 20px;
    max-width: 400px;
}
.logo-cat{
    width: 55px;
}
</style>
<div class="container-fluid invoice-container">
    <div class="row invoice-header">
       <div class="invoice-col">
           
          <p><img src="{{asset('assets/images/logo.png')}}" class="logo-cat" title="CAT"/></p>
          <h3>Slip #{{ sprintf('%04d', $data->id) }}</h3>
       </div>
       <div class="invoice-col text-center">
          <div class="invoice-status text-right">
          <span class=""></span>
          </div>
       </div>
    </div>
    <hr>
    <div class="row">
       <div class="invoice-col right">
          <strong>Pay To</strong>
          <address class="small-text">
             {{ $data->created_by_name }}<br/>
             {{ auth()->user()->email }} <br>
             {{ $rekening->bank->name??"" }}<br>
             a/n {{ $rekening->name_on_account??"" }} <br>
             {{ $rekening->account_number??"" }}
          </address>
       </div>
       <div class="invoice-col">
          <strong>Payroll From</strong>
          <address class="small-text">
             CAT<br/>                        
             PT. Cahaya Andhika Tamara<br/>
             Jl. Utan Kayu Raya No. 46. Kel Utan Kayu Utara<br/>
             Kec: Matraman, Jakarta Timur, DKI Jakarta<br/>
             Indonesia
          </address>
       </div>
    </div>
    <div class="row">
       <div class="invoice-col right">
          <strong>Payment Method</strong><br>
          <span class="small-text" data-role="paymethod-info">
          Bank Transfer</span>
          <br/>
       </div>
       <div class="invoice-col">
          <strong>Date Period</strong><br>
          <span class="small-text">
          {{ Date("l, F jS, Y",strtotime($data->date_period)) }}<br><br>
          </span>
       </div>
    </div>
    <br/>
    <div class="panel panel-default">
       <div class="panel-heading">
          <h3 class="panel-title"><strong>Invoice Items</strong></h3>
       </div>
       <div class="panel-body">
          <div class="table-responsive">
             <table class="table table-condensed">
                <thead>
                   <tr>
                      <td><strong>Description</strong></td>
                      <td width="20%" class="text-center"><strong>Amount</strong></td>
                   </tr>
                </thead>
                <tbody>
                   <tr>
                      <td>Payment ({{ Date("d/m/Y",strtotime($data->date_period)) }}) *</td>
                      <td class="text-center">$. {{ round($data->amount,2) }} </td>
                   </tr>
                   <tr>
                      <td class="total-row text-right"><strong>Sub Total</strong></td>
                      <td class="total-row text-center">$. {{ round($data->amount,2) }} </td>
                   </tr>
                   <tr>
                      <td class="total-row text-right"><strong>Total</strong></td>
                      <td class="total-row text-center">$. {{ round($data->amount,2) }} </td>
                   </tr>
                </tbody>
             </table>
          </div>
       </div>
    </div>
    <!-- <strong>Withdraw Notes</strong>
    <ul>
       <li>{{ $data->approved_description??"-" }}</li>
    </ul> -->
    <div class="pull-right btn-group btn-group-sm hidden-print" data-html2canvas-ignore="true">
       <a href="javascript:window.print()" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
       <button class="btn btn-default" id="getPDF" onclick="getPDF()"><i class="fas fa-download"></i> Download</button>
       @if($data->status==1)
        <a href="{{asset('storage/bukti/'.$data->proof_of_payment)}}" class="btn btn-default" target="_blank"><i class="fas fa-print"></i> Proof Of Payment</a>
       @endif 

    </div>
 </div>
 <p class="text-center hidden-print" data-html2canvas-ignore="true" id="ignorePDF"><a href="{{route("employee.$module_name.index")}}">&laquo; Back to Employee Area</a></a></p>

<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
 <script>
    function getPDF() {
        var element =window.document.getElementsByTagName("body")[0];
        html2pdf(element,{
            filename:"Invoice-{{ sprintf('%04d', $data->id) }}"
        });
    }
 </script>