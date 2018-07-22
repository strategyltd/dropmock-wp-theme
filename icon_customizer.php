<?php

class O2_Customizer_Icon_Picker_Control extends WP_Customize_Control {

        public $type = 'o2-icon-picker';

        public $iconset = array();

        public function to_json() {
            if ( empty( $this->iconset ) ) {
                $this->iconset = 'fa';
            }
            $iconset               = $this->iconset;
            $this->json['iconset'] = $iconset;
            parent::to_json();
        }

        public function enqueue() {
            wp_enqueue_script( 'o2-icon-picker-ddslick-min', O2_DIRECTORY_URI . 'controls/icon-picker/assets/js/jquery.ddslick.min.js', array( 'jquery' ) );
            wp_enqueue_script( 'o2-icon-picker-control', O2_DIRECTORY_URI . 'controls/icon-picker/assets/js/icon-picker-control.js', array( 'jquery', 'o2-icon-picker-ddslick-min' ), '', true );
            if ( in_array( $this->iconset, array( 'genericon', 'genericons' ) ) ) {
                wp_enqueue_style( 'genericons', O2_DIRECTORY_URI . 'assets/genericons/genericons.css' );
            } elseif ( in_array( $this->iconset, array( 'dashicon', 'dashicons' ) ) ) {
                wp_enqueue_style( 'dashicons' );
            } else {
                wp_enqueue_style( 'font-awesome', O2_DIRECTORY_URI . 'assets/font-awesome/css/font-awesome.min.css' );
            }
        }

        public function render_content() {
            if ( empty( $this->choices ) ) {
                if ( in_array( $this->iconset, array( 'genericon', 'genericons' ) ) ) {
                    require_once O2_DIRECTORY . 'controls/icon-picker/inc/genericons-icons.php';
                    $this->choices = o2_genericons_list();
                } elseif ( in_array( $this->iconset, array( 'dashicon', 'dashicons' ) ) ) {
                    require_once O2_DIRECTORY . 'controls/icon-picker/inc/dashicons-icons.php';
                    $this->choices = o2_dashicons_list();
                } else {
                    require_once O2_DIRECTORY . 'controls/icon-picker/inc/fa-icons.php';
                    $this->choices = o2_font_awesome_list();
                }
            }
        ?>
            <label>
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif;
                if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
                <select class="o2-icon-picker-icon-control" id="<?php echo esc_attr( $this->id ); ?>">
                    <?php foreach ( $this->choices as $value => $label ) : ?>
                        <option value="<?php echo esc_attr( $value ); ?>" <?php echo selected( $this->value(), $value, false ); ?> data-iconsrc="<?php echo esc_attr( $value ); ?>">
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        <?php }

    }