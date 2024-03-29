// //
// //{block name="backend/emotion/view/detail/elements/base"}
// //{$smarty.block.parent}
// Ext.define('Shopware.apps.Emotion.view.detail.elements.ProductList', {
//
//     /**
//      * Extend from the base class for the grid elements.
//      */
//     extend: 'Shopware.apps.Emotion.view.detail.elements.Base',
//
//     /**
//      * Create the alias matching with the xtype you defined for your element.
//      * The pattern is always 'widget.detail-element-' + xtype
//      */
//     alias: 'widget.detail-element-emotion-components-product-list',
//
//     /**
//      * You can define an additional CSS class which will be used for the grid element.
//      */
//     componentCls: 'emotion--product-list',
//
//     /**
//      * Define the path to an image for the icon of your element.
//      * You could also use a base64 string.
//      */
//     icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAdCAYAAADCdc79AAACrUlEQVRYhe2XT0gUURzHP25rBxHSg1hpIiIUBJYiUh006CwZnuchHV4EQcHrUNAhb15ediveIXMGhE5pVhBUBy8RBtmhW5D9A9PDGkSlVnSYt+1rm9lZx7YI/MLA8nu/P5/5wW/n96pIKW38LNALDNgHYAqYBGaUFGtp8lalhKkBLgBDwI4Ilxxwx8LdU1J8/GNA2vgNQD9hF9qcQo+tSw+FLu2OSPEFuG9jppUUi6mBtPGHgBGgMeJ4AbhlCz1UUqxo4+9x4Hoi8i8C55QUY3E1MyVgapUU14EmoA8YBV46LtsBCdwFlrTxbwCdwBUlxQGgGTgJ3AYuA4eBnUqKMW382ri6sR3Sxl8C5gg7MKWkeGvtHRS60BkRugZcAoaVFJ+dfM3AURu3X0nRsF6gZWCbY3pi4SaVFM+tTwsRU6akeGXP9zrn3U6uD0qKuo0CuXqRhwMeKSm+25gMcNCBaI+JjwXKxgElqB04a5/32vjHrP0m0QNQttICuWp0IDYEAyWm7F9pEyhJm0BJ+q+AVipYNzZ3KaA2YBDwCfebjSpncw3a3JEqa0HTxt/Cr9thS5GL+0/t6jWFT8yMkuJbUq20G2MnhS/3viKgZxQ2hKfrzf0bkDZBDbCqpPe1TLhWwpUDoFpJMV9eXJAFtirpfYoF0ibYRfh2R5T0lstJnFbaBHXAA2BASe9N3p5xHA4Bs0BXJUGK1AXM2tqA7ZA2wXHgKlBt7f1AqZvCvJLefKlK2gTthGtsnGqBaft7DTihpDeW1SYYBc4UOU9TWsPAxQSfU8DpBJ+8qoFr2gQdGcK9ebXMwEpqFZjLKOmNE94qFpzDVqC+xDNSRoHzCTlaHd8FoE9Jb/znlGkTNBFOWDdQ/5emLEd4eRhQ0nsHzpRZQy8wUUmQIk0AvXkYgB+d+9cIwuQ1xwAAAABJRU5ErkJggg==',
//
//     typeSnippets: {
//         'newcomer': '{s name="article_slider_type/store/newcomer" namespace="backend/emotion/view/components/article_slider_type"}{/s}',
//         'topseller': '{s name="article_slider_type/store/topseller" namespace="backend/emotion/view/components/article_slider_type"}{/s}',
//         'price_asc': '{s name="article_slider_type/store/price_asc" namespace="backend/emotion/view/components/article_slider_type"}{/s}',
//         'price_desc': '{s name="article_slider_type/store/price_desc" namespace="backend/emotion/view/components/article_slider_type"}{/s}',
//         'product_stream': '{s name="article_slider_type/store/product_stream" namespace="backend/emotion/view/components/article_slider_type"}{/s}',
//         'random_product': '{s name="article_slider_type/store/random_product" namespace="backend/emotion/view/components/article_slider_type"}{/s}'
//     },
//     /**
//      * You can override the original `createPreview()` method
//      * to create a custom grid preview for your element.
//      *
//      * @returns { string }
//      */
//     createPreview: function() {
//         var me = this,
//             preview = '',
//             content = '',
//             type = me.getConfigValue('product_list_type');
//
//         if (Ext.isDefined(type)) {
//             content += Ext.String.format('<div class="x-emotion-preview-title">[0]:</div>', me.getLabel());
//
//             if (type === 'selected_article' || type === 'selected_variant') {
//                 var products = me.getConfigValue(type + 's').split('|');
//
//                 if (products.length > 0) {
//                     Ext.each(products, function(product) {
//                         if (product) {
//                             content += Ext.String.format('<div class="article-ordernumber">[0]</div>', product);
//                         }
//                     });
//                 }
//
//             } else {
//                 content += Ext.String.format('<div class="article-type">[0]</div>', me.typeSnippets[type]);
//             }
//
//             preview = Ext.String.format('<div class="x-emotion-product-list-preview">[0]</div>', content);
//         }
//
//         return preview;
//     }
// });
// //{/block}