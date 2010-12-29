#! /bin/bash

#
# ZFDocumentor
#
# LICENSE
#
# This source file is subject to the new BSD license that is bundled
# with this package in the file LICENSE.txt.
# If you did not receive a copy of the license and are unable to
# obtain it through the world-wide-web, please send an email
# to perraud.mickael@orange.fr so we can send you a copy immediately.
#
# @category  Documentation
# @author    Mickael Perraud <mikaelkael@php.net>
# @copyright Copyright (c) 2010-2011 Mickael Perraud <perraud.mickael@orange.fr>
# @license   http://framework.zend.com/license/new-bsd     New BSD License
#
date
export LANG=en_US.UTF8
echo Cleaning
make clean
make -e html ZF_LANG=en ZF_VERSION=1.11
make -e html ZF_LANG=de ZF_VERSION=1.11
make -e html ZF_LANG=es ZF_VERSION=1.11
make -e html ZF_LANG=fr ZF_VERSION=1.11
make -e html ZF_LANG=ja ZF_VERSION=1.11
make -e html ZF_LANG=pt-br ZF_VERSION=1.11
make -e html ZF_LANG=en ZF_VERSION=1.10
make -e html ZF_LANG=de ZF_VERSION=1.10
make -e html ZF_LANG=es ZF_VERSION=1.10
make -e html ZF_LANG=fr ZF_VERSION=1.10
make -e html ZF_LANG=ja ZF_VERSION=1.10
make -e html ZF_LANG=pt-br ZF_VERSION=1.10
make -e html ZF_LANG=en ZF_VERSION=1.9
make -e html ZF_LANG=de ZF_VERSION=1.9
make -e html ZF_LANG=fr ZF_VERSION=1.9
make -e html ZF_LANG=ja ZF_VERSION=1.9
make -e html ZF_LANG=en ZF_VERSION=1.8
make -e html ZF_LANG=de ZF_VERSION=1.8
make -e html ZF_LANG=fr ZF_VERSION=1.8
make -e html ZF_LANG=ja ZF_VERSION=1.8
make -e html ZF_LANG=en ZF_VERSION=1.7
make -e html ZF_LANG=de ZF_VERSION=1.7
make -e html ZF_LANG=fr ZF_VERSION=1.7
make -e html ZF_LANG=ja ZF_VERSION=1.7
make -e html ZF_LANG=en ZF_VERSION=1.6
make -e html ZF_LANG=de ZF_VERSION=1.6
make -e html ZF_LANG=fr ZF_VERSION=1.6
make -e html ZF_LANG=ja ZF_VERSION=1.6
make -e html ZF_LANG=en ZF_VERSION=1.5
make -e html ZF_LANG=de ZF_VERSION=1.5
make -e html ZF_LANG=fr ZF_VERSION=1.5
make -e html ZF_LANG=ja ZF_VERSION=1.5
make -e html ZF_LANG=en ZF_VERSION=1.0
make -e html ZF_LANG=de ZF_VERSION=1.0
make -e html ZF_LANG=fr ZF_VERSION=1.0
make -e html ZF_LANG=ja ZF_VERSION=1.0
cd output
tar -czf html.tar.gz html
date