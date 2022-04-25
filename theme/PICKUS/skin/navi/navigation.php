		<!-- 서브 메뉴 -->
		<ul class="category_submenu_box">
            <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);
            for ($i=0; $row=sql_fetch_array($result); $i++) {
				if( $row['me_name'] == "포인트몰" ) continue;
				
			?>
				<li class="first-child_<?php echo $i?>">
					<dl class="category_submenu">
			<?php
                $sql2 = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '4'
                              and substring(me_code, 1, 2) = '{$row['me_code']}'
                            order by me_order, me_id ";
                $result2 = sql_query($sql2);

                for ($k=0; $row2=sql_fetch_array($result2); $k++) {
			?>
					<dd><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'];?></a></dd>
			<?php
				}
			?>
					</dl>
				</li>
			<?php
			}
			?>
		</ul>
		<!-- //서브 메뉴 -->
