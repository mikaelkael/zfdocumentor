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
# @copyright   Copyright (c) 2010-2011 Mickael Perraud <perraud.mickael@orange.fr>
# @license    http://framework.zend.com/license/new-bsd     New BSD License

find -name '*.xml' -print0 | xargs -0 grep '<programlisting' | sed 's/.*language="\(.*\)".*/\1/' | sort | uniq -c | sort -nr