<?php

class WP_Example_Process extends WP_Background_Process {

	use WP_Example_Logger;

	/**
	 * @var string
	 */
	protected $action = 'example_process';

	/**
	 * Task
	 *
	 * Override this method to perform any actions required on each
	 * queue item. Return the modified item for further processing
	 * in the next pass through. Or, return false to remove the
	 * item from the queue.
	 *
	 * @param mixed $item Queue item to iterate over
	 *
	 * @return mixed
	 */
	protected function task( $product ) {

		if($product->action == 'add'){
			$product_ID = dropmockStoreAddProduct([
	            'id' => $product->id,
	            'title' => array_shift(explode("(tags", $product->name)),
	            'imgsrc' => $product->thumbnail,
	            'category' => ucfirst(strtolower($product->type)),
	            'virtual' => 'yes',
	            'desc' => $product->description,
	            'meta' => [
	                'type' => ucfirst(strtolower($product->type)),
	                'preview_url' => $product->preview_url,
	                'uuid' => $product->uuid,
	                'extra' => $product->extra,
	                'vendor' => $product->vendor
	            ],
	        ]);
		}

		if($product->action == 'remove'){
			dropmockStoreDeleteProduct($product->ID);
		}

		$i = (int)get_transient( 'sync_in_progress_done' );
		$i++;
		set_transient( 'sync_in_progress_done', $i);
		

		return false;
	}

	/**
	 * Complete
	 *
	 * Override if applicable, but ensure that the below actions are
	 * performed, or, call parent::complete().
	 */
	protected function complete() {

		delete_transient('sync_in_progress');
		delete_transient('delete_in_progress');
		delete_transient('sync_in_progress_done');
		delete_transient('sync_in_progress_total');
		parent::complete();

		// Show notice to user or perform some other arbitrary task...
	}

}