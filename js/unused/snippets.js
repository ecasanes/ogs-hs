var step_0_validation_properties = {
		        message: 'This value is not valid',
		        feedbackIcons: {
		            valid: '',
		            invalid: '',
		            validating: ''
		        },
		        fields: {
		            case_file_name: {
		                message: 'Name is not valid',
		                validators: {
		                    notEmpty: {
		                        message: 'Name is required and cannot be empty'
		                    }
		                }
		            },
		            /*case_summary: {
		                message: 'Summary is not valid',
		                validators: {
		                    notEmpty: {
		                        message: 'Summary is required and cannot be empty'
		                    }
		                }
		            },*/
		            asset_type: {
		                message: 'Asset Type is not valid',
		                validators: {
		                    notEmpty: {
		                        message: 'Asset Type is required and cannot be empty'
		                    }
		                }
		            },
		            justification: {
		                message: 'Justification is not valid',
		                validators: {
		                    notEmpty: {
		                        message: 'Justification is required and cannot be empty'
		                    }
		                }
		            },
		            system: {
		                message: 'System is not valid',
		                validators: {
		                    notEmpty: {
		                        message: 'System is required and cannot be empty'
		                    }
		                }
		            },
		            system_subcategory: {
		                message: 'System Subcategory is not valid',
		                validators: {
		                    notEmpty: {
		                        message: 'System Subcategory is required and cannot be empty'
		                    }
		                }
		            },
		            equipment_category: {
		                message: 'Equipment Category is not valid',
		                validators: {
		                    notEmpty: {
		                        message: 'Equipment Category is required and cannot be empty'
		                    }
		                }
		            },
		            equipment_class: {
		                message: 'Equipment Class is not valid',
		                validators: {
		                    notEmpty: {
		                        message: 'Equipment Class is required and cannot be empty'
		                    }
		                }
		            }
		        }
		};

	    var step_1_validation_properties = {
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            comment: 'Equipment Description is not valid',
                validators: {
                    notEmpty: {
                        message: 'Equipment Description is required and cannot be empty'
                    }
                }
	        }
	    };

	    var step_2_validation_properties = {
	    	message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            summary: {
	                message: 'Summary is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Summary is required and cannot be empty'
	                    }
	                }
	            },
	            detection_notification: {
	                message: 'Notification is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Notification is required and cannot be empty'
	                    }
	                }
	            },
	            detection_date: {
	                validators: {
	                    date: {
	                        format: 'MM/DD/YYYY',
	                        message: 'The value is not a valid date'
	                    }
	                }
	            },
	            detection_description: {
	                message: 'Description is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Description is required and cannot be empty'
	                    }
	                }
	            },
	            detection_details: {
	                message: 'Details is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Details is required and cannot be empty'
	                    }
	                }
	            },
	            failure_notification: {
	                message: 'Notification is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Notification is required and cannot be empty'
	                    }
	                }
	            },
	            failure_description: {
	                message: 'Description is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Description is required and cannot be empty'
	                    }
	                }
	            },
	            area_of_impact_1: {
	                message: 'Area of Impact is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'at least 1 Area of Impact is required and cannot be empty'
	                    }
	                }
	            },
	            priority_1: {
	                message: 'Priority is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Priority is required and cannot be empty'
	                    }
	                }
	            },

	        }
	    }

	    var step_3_validation_properties = {
	    	message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            summary: {
	                message: 'Summary is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Summary is required and cannot be empty'
	                    }
	                }
	            },
	            failure_mechanism: {
	                message: 'Failure Mechanism is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Failure Mechanism is required and cannot be empty'
	                    }
	                }
	            },
	            failure_mechanism_subdivision: {
	                message: 'Sub Division is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Sub Division is required and cannot be empty'
	                    }
	                }
	            },
	            failure_cause_1: {
	                message: 'Failure Cause is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'at least 1 Failure Cause is required and cannot be empty'
	                    }
	                }
	            },
	            failure_cause_1_subdivision: {
	                message: 'Sub Division is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Sub Division is required and cannot be empty'
	                    }
	                }
	            }

	        }
	    }

	    var step_4_validation_properties = {
	    	message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            summary: {
	                message: 'Summary is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Summary is required and cannot be empty'
	                    }
	                }
	            },
	            risks: {
	                message: 'Risks is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Risks is required and cannot be empty'
	                    }
	                }
	            },
	            maintenance_activity_1: {
	                message: 'Maintenance Activity is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'at least 1 Maintenance Activity is required and cannot be empty'
	                    }
	                }
	            }
	        }
	    }

	    var step_5_validation_properties = {
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            summary: {
	                message: 'Summary is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Summary is required and cannot be empty'
	                    }
	                }
	            }
	        }
	    };

	    var step_6_validation_properties = {
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            summary: {
	                message: 'Summary is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Summary is required and cannot be empty'
	                    }
	                }
	            },
	            area_of_impact_1: {
	                message: 'Area of Impact is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'at least 1 Area of Impact is required and cannot be empty'
	                    }
	                }
	            },
	            priority_1: {
	                message: 'Result is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'at least 1 Result is required and cannot be empty'
	                    }
	                }
	            }
	        }
	    };

	    var step_7_validation_properties = {
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            summary: {
	                message: 'Summary is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Summary is required and cannot be empty'
	                    }
	                }
	            }
	        }
	    };

	    var ofi_2_validation_properties = {
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            summary: {
	                message: 'Summary is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Summary is required and cannot be empty'
	                    }
	                }
	            },
	            benefits: {
	                message: 'Constraints is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Constraints is required and cannot be empty'
	                    }
	                }
	            }
	        }
	    };

	    var ofi_3_validation_properties = {
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            summary: {
	                message: 'Summary is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Summary is required and cannot be empty'
	                    }
	                }
	            },
	            benefits: {
	                message: 'Benefits is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Benefits is required and cannot be empty'
	                    }
	                }
	            },
	            cost_breakdown: {
	                message: 'Cost Breakdown is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Cost Breakdown is required and cannot be empty'
	                    }
	                }
	            }
	        }
	    };

	    var ofi_4_validation_properties = {
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: '',
	            invalid: '',
	            validating: ''
	        },
	        fields: {
	            summary: {
	                message: 'Summary is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'Summary is required and cannot be empty'
	                    }
	                }
	            }
	        }
	    };


	    $("#txtQty").keyup(function() {
			    var $this = $(this);
			    $this.val($this.val().replace(/[^\d.]/g, ''));        
			});