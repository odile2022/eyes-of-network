<?php

$extraHeaderTags = <<<EOF

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
	.table-responsive {
        margin: 30px 0;
    }
	.table-wrapper {
		min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
	.table-title .btn {
		color: #fff;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td i.edit {
        color: #FFC107;
    }
    table.table td i.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */

	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}
	.form-fieldset{
		padding: 0.5em 1em;
		margin: 0 2px;
		border: 1px solid silver;
	}
	.form-fieldset legend{
		width: auto;display: inline;border: none;margin-bottom: 0;
	}
	.form-fieldset legend .delete.material-icons{
		color:#F44336; position: relative; top: 5px;
	}
	.form-fieldset legend .delete.material-icons:hover{
		cursor: pointer;
	}
	.lds-spinner {
		color: official;
		display: inline-block;
		position: relative;
		width: 20px;
		height: 20px;
	  }
	  .lds-spinner div {
		transform-origin: 10px 10px;
		animation: lds-spinner 1.2s linear infinite;
	  }
	  .lds-spinner div:after {
		content: " ";
		display: block;
		position: absolute;
		top: 1px;
		left: 9px;
		width: 2px;
		height: 4px;
		border-radius: 5%;
		background: #fff;
	  }
	  .lds-spinner div:nth-child(1) {
		transform: rotate(0deg);
		animation-delay: -1.1s;
	  }
	  .lds-spinner div:nth-child(2) {
		transform: rotate(30deg);
		animation-delay: -1s;
	  }
	  .lds-spinner div:nth-child(3) {
		transform: rotate(60deg);
		animation-delay: -0.9s;
	  }
	  .lds-spinner div:nth-child(4) {
		transform: rotate(90deg);
		animation-delay: -0.8s;
	  }
	  .lds-spinner div:nth-child(5) {
		transform: rotate(120deg);
		animation-delay: -0.7s;
	  }
	  .lds-spinner div:nth-child(6) {
		transform: rotate(150deg);
		animation-delay: -0.6s;
	  }
	  .lds-spinner div:nth-child(7) {
		transform: rotate(180deg);
		animation-delay: -0.5s;
	  }
	  .lds-spinner div:nth-child(8) {
		transform: rotate(210deg);
		animation-delay: -0.4s;
	  }
	  .lds-spinner div:nth-child(9) {
		transform: rotate(240deg);
		animation-delay: -0.3s;
	  }
	  .lds-spinner div:nth-child(10) {
		transform: rotate(270deg);
		animation-delay: -0.2s;
	  }
	  .lds-spinner div:nth-child(11) {
		transform: rotate(300deg);
		animation-delay: -0.1s;
	  }
	  .lds-spinner div:nth-child(12) {
		transform: rotate(330deg);
		animation-delay: 0s;
	  }
	  @keyframes lds-spinner {
		0% {
		  opacity: 1;
		}
		100% {
		  opacity: 0;
		}
	  }

</style>
EOF;

require_once("./DB.php");
include("../../header.php");
include("../../side.php");
include("ged_functions.php");


?>
