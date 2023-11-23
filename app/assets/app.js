import { registerReactControllerComponents } from '@symfony/ux-react';
import './bootstrap.js';
import './styles/app.scss';

require('bootstrap');

registerReactControllerComponents(require.context('./react/apps', true, /\.(j|t)sx?$/));