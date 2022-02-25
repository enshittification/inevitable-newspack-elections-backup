import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
 import Edit from './edit';

 /**
 * Style dependencies - will load in editor
 */
//import './editor.scss';
import './view.scss';

import metadata from './block.json';
const { name, attributes, category } = metadata;

export const title = 'GovPack Profile'

registerBlockType( 'govpack/profile', {
	apiVersion: 2,
	title,
    category,
    attributes,
	icon: 'groups',
	keywords: [ 'govpack' ],
    styles: [
		{ name: 'default', label:  'Default', isDefault: true },
		{ name: 'center', label:  'Centered' },
	],
	edit : Edit,
	save() {
		return null;
	},
} );