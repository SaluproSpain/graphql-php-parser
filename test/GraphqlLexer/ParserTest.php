<?php
/**
 * @author Paweł Dziok <pdziok@gmail.com>
 */

namespace Salupro\GraphqlParser;

use Salupro\GraphqlParser\Ast\Argument;
use Salupro\GraphqlParser\Ast\Field;
use Salupro\GraphqlParser\Ast\Literal;
use Salupro\GraphqlParser\Ast\Query;
use Salupro\GraphqlParser\Ast\Variable;

class ParserTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider getSampleData
     */
    public function testLexingSampleQueries($rawQuery, $parsedQuery){
         $parser = new Parser($rawQuery);
         $this->assertEquals($parsedQuery, $parser->parseQuery());
    }

    public function testArguments()
    {
        $parser = new Parser('{
    user(id: <id>) {
      id,
      nickname,
      avatar(width: 80, height: 80) {
        url(protocol: "https")
      },
      posts(first: <count>) {
        count,
        edges {
          post: node {
            id,
            title,
            published_at
          }
        }
      }
    }
  }');
        $parsed_query = $parser->parseQuery();
        $params = $parsed_query->fieldList[0]->argumentsToArray();
        $this->assertArrayHasKey('id', $params);
    }


    public function getSampleData()
    {
        return [
            [
                '{
    user(id: <id>) {
      id,
      nickname,
      avatar(width: 80, height: 80) {
        url(protocol: "https")
      },
      posts(first: <count>) {
        count,
        edges {
          post: node {
            id,
            title,
            published_at
          }
        }
      }
    }
  }',
                new Query([
                    new Field(
                        'user',
                        null,
                        [
                            new Argument('id', new Variable('id'))
                        ],
                        [
                            new Field('id'),
                            new Field('nickname'),
                            new Field(
                                'avatar',
                                null,
                                [
                                    new Argument('width', new Literal('80')),
                                    new Argument('height', new Literal('80'))
                                ],
                                [
                                    new Field(
                                        'url',
                                        null,
                                        [
                                            new Argument('protocol', new Literal('https'))
                                        ]
                                    )
                                ]
                            ),
                            new Field(
                                'posts',
                                null,
                                [
                                    new Argument('first', new Variable('count')),
                                ],
                                [
                                    new Field('count'),
                                    new Field(
                                        'edges',
                                        null,
                                        [],
                                        [
                                            new Field(
                                                'node',
                                                'post',
                                                [],
                                                [
                                                    new Field('id'),
                                                    new Field('title'),
                                                    new Field('published_at')
                                                ]
                                            )
                                        ]
                                    )
                                ]
                            )
                        ]
                    )
                ])
            ]
        ];
    }
}
